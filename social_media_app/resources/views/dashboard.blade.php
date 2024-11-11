<x-app-layout>
    <div class="py-6">
        <div ng-app="socialApp" ng-controller="PostController" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form ng-submit="createPost()" class="bg-white p-6 rounded-lg shadow-md">
                <textarea ng-model="newPost.content" placeholder="What's on your mind?" required class="w-full"></textarea>
                <select ng-model="newPost.visibility" class="mt-2 w-full">
                    <option value="Public">Public</option>
                    <option value="Friends">Friends</option>
                    <option value="Only me">Only me</option>
                </select>
                <br><br>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Post') }}
                </button>
            </form>
            
            <!-- Display posts -->
            <div ng-repeat="post in posts" class="bg-white p-6 rounded-lg shadow-md mt-4">
                <small>
                    <span class="text-xl font-bold mb-4">@{{ post.user.name }}</span> on
                    <span>@{{ post.created_at | date:'medium' }}</span> -
                    <span class="text-gray-600">@{{ post.visibility }}</span>
                </small>
                <br>
                <br>
                <p class="text-xl font-semibold mb-4">@{{ post.content }}</p>
                <br>
                <button ng-click="likePost(post)" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Like') }} (@{{ post.likes_count }})
                </button>
                <button ng-if="post.user_id === {{ Auth::id() }}" ng-click="deletePost(post)" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    {{ __('Delete') }}
                </button>
                <br>
                <br>        
                <form ng-submit="addComment(post)">
                    <input type="text" ng-model="post.newComment" placeholder="Add a comment" class="w-full mt-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-2">
                        {{ __('Comment') }}
                    </button>
                    <br>
                    <br>
                </form>

                <ul class="mt-2">
                    <li ng-repeat="comment in post.comments">
                        <small><span class="text-xl font-bold mb-4">@{{ comment.user.name }}</span> on <span>@{{ comment.created_at | date:'medium' }}</span></small>
                        <br>
                        <p class="text-xl font-semibold mb-6">@{{ comment.comment }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Set the default value for visibility
        $scope.newPost = {
            visibility: 'Public' // Default selection
        };
    </script>

</x-app-layout>
