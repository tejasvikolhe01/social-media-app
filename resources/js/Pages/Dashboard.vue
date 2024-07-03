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
                    <p id="user" class="d-none">{{ $page.props.auth.user.id }}</p>
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
                        <div class="post_item" v-for="(post, index) in allPostsLoaded">
                            <div class="post_user">{{ post.user.first_name }}</div>
                            <span class="post_date">{{ post.created_at}}</span>
                            <p class="post_content">{{ post.post_content}}</p>
                            <span v-if="post.likes.length" class="post_likes" @click="submitLikes(post.id, 'Post')">
                                <i class="zmdi zmdi-thumb-up"></i>{{ post.likes.length }} Like
                            </span>
                            <span v-else class="post_likes" @click="submitLikes(post.id, 'Post')">
                                <i class="zmdi zmdi-thumb-up"></i>0 Like
                            </span>
                            <span class="post_comments_count" @click="showComments">
                                <i class="zmdi zmdi-comment-text"></i> {{ post.comments.length }} Comment
                            </span>
                            <div class="post_comments">
                                <div class="post_comment" v-for="(comment, index) in post.comments">
                                    <p>
                                        <span class="d-block"><strong>{{ comment.user.first_name }}</strong></span>
                                        <span class="d-block">{{ comment.comment_text }}</span>
                                    </p>
                                    <span v-if="comment.likes.length" class="post_comment_like" @click="submitLikes(comment.id, 'Comment')">
                                        <i class="zmdi zmdi-thumb-up"></i> {{ comment.likes.length }} Like
                                    </span>
                                    <span v-else class="post_comment_like" @click="submitLikes(comment.id, 'Comment')">
                                        <i class="zmdi zmdi-thumb-up"></i> 0 Like
                                    </span>
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
                        <PrimaryButton v-if="this.posts.length>3 && this.postLength < this.posts.length" @click="loadMore" class="offset-lg-5 col-md-3">
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
                entryPresnt: false,
                loggedInUser:0,
                postLength: 3,
            }
        },
        mounted() {
            this.getAllPosts();//fetch all post on page load
        },
        methods: {
            //submit a post
            submitPost() {
                axios
                .post('/create-post', {
                    post_content: this.post_content
                })
                .then(response => (window.location.reload()))
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
                .then(response => (window.location.reload()))
            },
            //hide & show comments section
            showComments(event) {
                let targetElement = event.target;
                let nextElement = targetElement.nextElementSibling;
                nextElement.classList.toggle("show");
            },
            //like & dislike functionality
            submitLikes(id, type) {
                axios
                .post('/submit-likes', {
                    id: id,
                    type: type
                })
                .then(response => (window.location.reload()))
            },
            loadMore() {
                if (this.postLength > this.posts.length) return;
                    this.postLength = this.postLength + 3;
            }
        },
        computed: {
            allPostsLoaded() {
                return this.posts.slice(0, this.postLength);
            },
        }
    }
</script>
