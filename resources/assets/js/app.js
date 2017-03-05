
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
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
								<h2><a :href="article.source_url" target="_blank">{{ article.title }}</a></h2>
								<div v-if="article.web_picture" class="image-box"><img :src="article.web_picture" />
								</div>
								<p v-if="article.description">{{ article.description }}...</p>
								<div class="article-footer">
									<a :href="article.source_url" target="_blank" class="read">Read</a>
								</div>
							</div>
						</div>
					</div>
					<!--//Article block-->
					<div v-if="hasMoreArticles" class="show-more" @click="loadMoreArticles">Show More
					</div>
					<div v-if="errorMessage" class="show-more">{{ errorMessage }}
					</div>
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
			isActive: true,
			articles: [],
			errorMessage: '',
			hasMoreArticles: false,
			page: 1
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
			const articleType = this.name.toLowerCase().replace(/ /g, '-')
			this.$http.get('/articles/' + articleType, {params:  {topic_id: topicId}} )
				.then((response) => {    	
					const responseData = response.data.data;
					this.articles = responseData.articles
					this.hasMoreArticles = responseData.pagination.hasMore
				}, (response) => {
    			 this.errorMessage = "No records found"
    		  });
		},
		/**
		 * Ajax loading articles
		 */
		loadMoreArticles() {
    		this.page += 1
    		const topicId = $("#special-article span").text()
    		this.$http.get('/articles/' + this.name.toLowerCase().replace(/ /g, '-'), {params:  {topic_id: topicId, page: this.page}} )
    		.then((response) => {
    			const responseData = response.body.data; 
    			for (var i = 0; i < responseData.articles.length; i++) {
                   this.articles.push(responseData.articles[i]);
                 }  
				if(responseData.articles.length == 0) {
					this.hasMoreArticles = false
					this.errorMessage = "No records found"
				}	 
    			
    		  }, (response) => {
    			 this.errorMessage = "No records found"
    		  });
    	},
	}	
});
const app = new Vue({
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
				this.successMessage = response.body.data.message
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
