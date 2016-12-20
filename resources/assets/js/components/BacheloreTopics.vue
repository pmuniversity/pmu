<template>
    <section class="common-section">
			<div class="container">
				<h2>BACHELOR'S DEGREE</h2>
				<p>Get your Bachelor's Degree in Product Management (B.P.M) from PM University by taking eight core courses in a rigid curriculum designed by the leading Product Managers of Tech. Topics range from building great products, agile development and SCRUM to creating product roadmaps that lead to truly amazing products!
</p>
				<ul class="pm-list">
					
					<li v-for="(topic, index) in topics">
					<a :href="topic.slug">
							<div class="media">
								<div class="media-left">
									<span class="pm-list-count">{{ index += 1 }}.</span>
								</div>
								<div class="media-body">{{ topic.title }}</div>
								<div class="media-right">
									<span class="r-more">READ</span>
								</div>
							</div>
					</a>				    
				  </li>
				</ul>
			</div>
		</section>
</template>

<script>
    export default {
      /*
         * The component's data.
         */
        data() {
            return {
                topics: []
            };
        },
        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },
        methods: {
			/**
			 * Prepare the component.
			 */
			prepareComponent() {
			    this.getTopics();
			},
			/**
			* Get bachelore topics.
			*/
			getTopics() {
				this.$http.get('/api/topics/bachelores-degree').then(response => {				
					this.topics = response.body.data.topics
				})
			}
        }
    }
</script>
