
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for building
 * robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to the
 * body of the page. From here, you may begin adding components to the
 * application, or feel free to tweak this setup for your needs.
 */

Vue.component('bachelore-topics', require('./components/BacheloreTopics.vue'));
Vue.component('master-topics', require('./components/MasterTopics.vue'));
Vue.component('specialization-topics', require('./components/SpecializationTopics.vue'));
Vue.component('tabs', {
    template: `
        <div>
            <section class="inner-tabs">
    			<div class="container">
        			<ul>
			            <li v-for="tab in tabs">
                        <a :href="tab.href" @click="selectTab(tab)" :class="{ 'active': tab.isActive }">{{ tab.name }}</a>
                    </li>
        			</ul>
    			</div>
    		</section>
    		<div class="tabs-details">
    			<slot></slot>
    		</div>
        </div>
    `,
    data() {
    	return {
    		tabs: []
    	}
    },
    created() {
    	this.tabs = this.$children
    },
    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.href == selectedTab.href);
            });
        }
    }
});

Vue.component('tab', {
	template: `
		<div v-if="isActive">
			<section class="inner-tab-content">
				<div class="container">
					<div id="top" class="detail-wrapper">
						<!--Article block-->
						<div v-for="article in articles" class="well">
							<div class="media">
								<div class="media-body">
									<h2><a :href="article.sourceUrl" target="_blank">{{ article.title }}</a></h2>
									<ul>
										<li>{{ article.authorName }}</li>
										<li><span class="dot"></span></li>
										<li>{{ article.authorDesignation }}</li>
										<li><span class="dot"></span></li>
										<li>{{ article.authorOffice }}</li>
										<li><span class="dot"></span></li>
										<li>{{ article.authorLocation }}</li>
									</ul>
									<div v-if="article.file_path" class="image-box"><img :src="article.file_path" /></div>
                        				<p v-if="article.description">{{ article.description }}...</p>
									<div class="article-footer">
										<a :href="article.sourceUrl" target="_blank" class="read">Read</a>
									</div>
								</div>
								<div class="media-right" v-if="article.articleType === 'videos'">
                    				<iframe width="300" height="169" :src="article.videoSrc" frameborder="0" allowfullscreen></iframe>
                    			</div>
							</div>
						</div>
						<!--//Article block-->
						<div v-if="hasMoreArticles" class="show-more" @click="loadMoreArticles">Show More</div>
						<div v-if="errorMessage" class="show-more">{{ errorMessage }}</div>
					</div>
				</div>
			</section>
		</div>
	`,
	props: {
		name: { required: true },
		selected: { default: false }
	},
	data() {
        return {
            isActive: false,
            articles: [],
            errorMessage: '',
            hasMoreArticles: false,
            page: 1,
            upvoted: false
        };
    },
    computed: {
        href() {
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        }
    },
    mounted() {
        this.isActive = this.selected;
        this.prepareComponent();
    },
    methods: {
    	/**
		 * Prepare the component.
		 */
    	prepareComponent() {
    		this.getArticles();
    	},
    	/**
		* Get articles.
		*/
		getArticles() {
    		const topicId = $("#special-article span").text()
    		this.$http.get('/api/articles/' + this.name.toLowerCase().replace(/ /g, '-'), {params:  {topicId: topicId}} )
    		.then((response) => {    			
    			const responseData = response.body.data;
    			this.articles = responseData.articles
    			this.hasMoreArticles = responseData.pagination.hasMore
    		  }, (response) => {
    			 this.errorMessage = response.body.message
    		  });
    	},
    	/**
    	 * Ajax loading articles
    	 */
    	loadMoreArticles() {
    		this.page += 1
    		const topicId = $("#special-article span").text()
    		this.$http.get('/api/articles/' + this.name.toLowerCase().replace(/ /g, '-'), {params:  {topicId: topicId, page: this.page}} )
    		.then((response) => {
    			const responseData = response.body.data; 
    			for (var i = 0; i < responseData.articles.length; i++) {
                   this.articles.push(responseData.articles[i]);
                 }    			
    			this.hasMoreArticles = responseData.pagination.hasMore
    		  }, (response) => {
    			 this.errorMessage = response.body.message
    		  });
    	},
    	upvote(id) {
    		this.$http.patch('/api/upvotes/' + id).then((response) => {    			
    			$('a#' + id).addClass('voted');
    			$("a#" + id + " .count").text(response.body.data.count)
    			}),(response) => {    				
    		}			  		
    	}
    }
});

new Vue({
    el: '#app',
    data: {
	    formInputs: {},
	    formErrors: {},
	    successMessage: '',
	    disabledButton: false
    },
    methods: {
    	submitForm: function(e) {
			var form = e.srcElement;
			var action = form.action;
			var csrfToken = form.querySelector('input[name="_token"]').value;
			this.formErrors = {}
			
			this.$http.post(action, this.formInputs, {
				headers: {
			        'X-CSRF-TOKEN': csrfToken
				}
			  })
			.then((response) => {
				this.successMessage = response.body.message
				//$('input[type="submit"]').prop('disabled', true);
				this.disabledButton = true
				this.formInputs.email = ''
			}, (response) => {
			    var errors = response.body.email;
			    this.formErrors = errors;
			  });
    	}
    }
});
