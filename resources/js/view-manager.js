const viewManager = () => ({
    maxViewedPosts: 10,
    canBeViewedIn: 2 * 60 * 60 * 1000, // 2 hours
    viewedPosts: [],
    addViewedPost(postId) {
        this.viewedPosts = [...this.viewedPosts, postId];
        if (this.viewedPosts.length >= this.maxViewedPosts) {
            this.sendViewedPosts();
        }
    },
    sendViewedPosts() {
        let data = JSON.parse(localStorage.getItem('viewedPosts')) || [];
        let previousViewedPosts = data.filter(function (post) {
            if (post === null) {
                return false;
            }
            return new Date().getTime() - post.dateTime < this.canBeViewedIn;
        });
        let previousViewedPostIds = previousViewedPosts.map(post => post.postId);
        let viewedPosts = this.viewedPosts.filter(postId => !previousViewedPostIds.includes(postId));
        this.viewedPosts = [];
        if (viewedPosts.length > 0) {
            this.$wire.call('updateViews', viewedPosts);
            viewedPosts = viewedPosts.map(function (postId) {
                return {
                    postId: postId,
                    dateTime: new Date().getTime()
                };
            });
            viewedPosts = [...previousViewedPosts, ...viewedPosts];
            localStorage.setItem('viewedPosts', JSON.stringify(viewedPosts));
        }
    },
    init() {
        window.addEventListener('post-viewed', (event) => {
            this.addViewedPost(event.detail.postId);
        });

        document.addEventListener('livewire:navigate', () => {
            this.sendViewedPosts();
        });

        window.addEventListener('beforeunload', () => {
            this.sendViewedPosts();
        });

        window.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') {
                this.sendViewedPosts();
            }
        });

        window.addEventListener('popstate', () => {
            this.sendViewedPosts();
        });
    }
});

export { viewManager }
