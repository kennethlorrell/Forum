export default {
	data() {
		return {
			items: []
		};
	},

	methods: {
		create(item) {
			this.items.push(item);

			this.$emit('created');
		},

		remove(index) {
			this.items.splice(index, 1);

			this.$emit('removed');

			flash('Reply has been deleted');
		}
	}
}