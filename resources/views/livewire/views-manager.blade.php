<div x-data="{
    viewedPosts: [],
    addViewedPost(postId) {
        this.viewedPosts = [...this.viewedPosts, postId];
    },
    sendViewedPosts() {
        if (this.viewedPosts.length > 0) {
            this.$wire.call('updateViews', this.viewedPosts);
            this.viewedPosts = [];
        }
    },
    init() {
        setInterval(() => {
            this.sendViewedPosts();
        }, 5000);

        document.addEventListener('livewire:navigate', () => {
            this.sendViewedPosts();
        });
    }
}" x-on:post-viewed.window="addViewedPost($event.detail.postId)"
>
</div>
