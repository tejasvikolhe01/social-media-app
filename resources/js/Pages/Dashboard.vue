<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-center">Dashboard</h2>
        </template>
        <div class="container">
            <div class="row">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="text-center">You're logged in!</div>
                    <form @submit.prevent="submitPost" class="new-post row g-3">
                        <InputLabel for="new-post" value="Write here" />
                        <div class="col-md-8">
                            <TextInput
                            id="new-post"
                            type="text"
                            placeholder="write something here"
                            v-model="post_content"
                            autofocus
                            />
                        </div>
                        <PrimaryButton class="col-md-4">
                            Post
                        </PrimaryButton>
                    </form>
                    <div class="post_items row g-3">
                        <div class="post_item" v-for="(post, index) in posts">
                            <div class="post_user">{{ post.user.first_name }}</div>
                            <span class="post_date">{{ post.created_at}}</span>
                            <p class="post_content">{{ post.post_content}}</p>
                            <span class="post_likes">
                                <i class="zmdi zmdi-thumb-up"></i>Likes
                            </span>
                            <span class="post_comments_count" @click="showComments">
                                <i class="zmdi zmdi-comment-text"></i>Comments
                            </span>
                            <div class="post_comments">
                                <div class="post_comment" v-for="(comment, index) in allcomments">
                                    <p v-if="comment.post_id == post.id">
                                        <span class="d-block"><strong>{{ comment.user.first_name }}</strong></span>
                                        <span class="d-block">{{ comment.comment_text }}</span>                                
                                    </p>
                                </div>
                            </div>
                            <div class="post_comment-box row g-3">
                                <div class="col-md-8">
                                    <TextInput
                                        type="text"
                                        placeholder="comment here"
                                        v-model="comments[index]"
                                    />
                                </div>
                                <PrimaryButton @click="postComment(comments[index], post.id)" class="col-md-4">
                                    post comment
                                </PrimaryButton>
                            </div>
                        </div><!-- post-item end -->
                        <PrimaryButton class="offset-lg-5 col-md-3">
                            Load More
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
    export default {
        data: function () {
            return {
                posts:[],
                comments:[],
                post_content: '',
                allcomments: []
            }
        },
        mounted() {
            this.getAllPosts();
            this.getAllComments();
        },
        methods: {
            //submit a post
            submitPost() {
                axios
                .post('/create-post', {
                    post_content: this.post_content
                })
                this.post_content='';
            },
            // fetch all posts
            getAllPosts() {
                axios
                .get('/posts')
                .then(response => (this.posts = response.data))
            },
            //submit a comment
            postComment(comment, id) {
                axios
                .post('/create-comment', {
                    post_id: id,
                    comment_text: comment,
                })
            },
            // fetch all comments
            getAllComments() {
                axios
                .get('/comments')
                .then(response => (this.allcomments = response.data))
            },
            //hide & show comments section
            showComments(event) {
                let targetElement = event.target;
                let nextElement = targetElement.nextElementSibling;
                nextElement.classList.toggle("show");
            }
        },
    }
</script>
