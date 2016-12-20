<template>
    <section class="common-section">
			<div class="container">
				<h2>MASTER'S DEGREE</h2>
				<p>Already a Product Manager or think you've got the skills to go after a Master's Degree in Product Management? The Masters in Product Management Degree (M.P.M) is for you. Dig deeper into the discipline of product management and go past the core curriculum and dive into twenty advanced product management courses that truly put your skills to the test!</p>
				<ul class="pm-list">
					
					<li v-for="(topic, index) in topics">
					<a :href="topic.slug">
							<div class="media">
								<div class="media-left">
									<span class="pm-list-count">{{ index += 1 }}.</span>
								</div>
								<div class="media-body">
									{{ topic.title }}  <span
										class="mark-read" v-if="index === 1">Mark as Read</span>
								</div>
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
			* Get all of the personal access tokens for the user.
			*/
			getTopics() {
				this.$http.get('/api/topics/masters-degree').then(response => {
					this.topics = response.body.data.topics
				})
			}
        }
    }
</script>
