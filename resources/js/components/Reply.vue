<template>
    <div class="card my-4" id="'reply-'+id">

        <div class="card-header d-flex justify-content-between">
            <div>
                <h4 class="card-title">
                    <a href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a>
                </h4>
                <h6 class="card-subtitle text-muted m-0" v-text="ago"></h6>
            </div>
            <div v-if="signedIn">
                <favorite :reply="data"></favorite>
            </div>
        </div>

        <div class="card-body">

            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-primary" @click="update">Update</button>
                <button class="btn" @click="editing = false">Cancel</button>
            </div>

            <div v-else>
                <p class="card-text" v-text="body"></p>
            </div>

        </div>

        <div class="card-footer d-flex" v-if="canUpdate">
            <button class="btn btn-secondary mr-3" @click="editing=true">Edit</button>
            <button class="btn btn-danger mr-3" @click="destroy">Delete</button>
        </div>

    </div>
</template>

<script>

    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {

      	props: ['data'],

        components: { Favorite },

     	data() {
     		return {
       			editing: false,
                id: this.data.id,
       			body: this.data.body
     		};
     	},

        computed: {

            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize(user => this.data.owner_id == user.id);
            },

            ago() {
                return moment.utc(this.data.created_at).fromNow();
            }
        },

     	methods: {

       		update() {
       			axios.patch('/replies/' + this.data.id, {
       				body: this.body
       			});

         		this.editing = false;

         		flash('Updated!');
         	},

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);
            }
     	}
   	}

</script>