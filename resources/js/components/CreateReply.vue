<template>
	<div>
		<div v-if="signedIn">
			<div class="form-group">
				<textarea class="form-control"
						  name="body"
						  rows="5"
						  required
						  placeholder="Do you mind share your opinion about the topic?"
						  v-model="body">		  	
				</textarea>
			</div>
			<button type="submit" 
					class="btn btn-primary mb-2" 
					@click="createReply">
				Add reply
			</button>
		</div>
		<p v-else class="text-center">
			Please, <a href="/login">login</a>, to participate in discussion
		</p>
	</div>
</template>

<script>

	export default {

		data() {
			return {
				body: ''
			};
		},

		computed: {
			signedIn() {
				return window.App.signedIn;
			}
		},

		methods: {
			createReply() {
				axios.post(location.pathname + '/replies', { body: this.body })
					.then(({data}) => {
						this.body = '';

						flash('Your reply has been created.');
					
						this.$emit('created', data);
					});
			}
		}
	}
	
</script>