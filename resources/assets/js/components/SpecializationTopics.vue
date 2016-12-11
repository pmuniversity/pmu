<template>
    <section class="common-section">
			<div class="container">
				<h2>SPECIALIZATION</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
					eleifend ornare lorem. Aliquam gravida et elit sed vulputate</p>
				<ul class="specialisation-list">
					
					<li v-for="(topic, index) in topics">
					<a :class="{ active: index === 0 }" :href="topic.slug">
							<div>
								<img :src="topic.picture"
									alt="Analytics" class="s-list-icon" />
							</div>
							<div class="s-list-name">{{ topic.title }}</div>
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
				this.$http.get('/api/topics/specialization').then(response => {
					this.topics = response.body.data.topics
				})
			}
        }
    }
</script>
