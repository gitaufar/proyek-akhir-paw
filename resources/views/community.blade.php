@extends('layout.main')

@section('content')
    <section class="mt-30 w-full flex flex-col items-center gap-2">
        <div class="w-140 flex flex-col pb-10 pt-2 bg-[#2F2B2E] gap-10 rounded-lg">
            <div class="flex flex-row px-10 gap-4">
                <img src="./png/profile_dummy.png" alt="profile" class="h-[50px]" />
                <form id="post-form" class="w-full flex flex-row rounded-lg px-2 py-2 gap-2" method="post" action="/ask">
                    @csrf
                    <textarea name="content" rows="1"
                        class="overflow-hidden px-4 py-2 border border-white outline-none bg-transparent text-white w-full rounded-lg"
                        placeholder="Tulis komentar..." id="comment-input"></textarea>

                    <button type="submit"
                        class="py-2 px-6 bg-amber-300 text-base font-semibold text-black rounded-lg h-fit">
                        Posting
                    </button>
                </form>
            </div>
            <div class="bg-white w-full h-0.5"></div>
        </div>
        <div id="post-container" class="py-2 gap-4 flex flex-col">
            @foreach ($posts as $p)
                <x-post-card :post-user-id="$userId" :likes="$p->likes->count()" :user-id="$p->author->id" :post-id="$p->id"
                    :author="$p->author->name" :content="$p->content" :timestamp="$p->formatted_timestamp" />
            @endforeach
        </div>
    </section>
@endsection

@section('script')
    <script>
        const textarea = document.getElementById('comment-input');
        const postContainer = document.getElementById('post-container');
        const postForm = document.getElementById('post-form');

        const adjustHeight = () => {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        };
        textarea.addEventListener('input', adjustHeight);

        postForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const content = textarea.value.trim();
            if (!content) return;

            try {
                const response = await fetch('/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ content: content })
                });

                if (!response.ok) throw new Error('Gagal mengirim');

                const data = await response.json();
                console.log(data);

                // Tambahkan post baru ke tampilan
                const newPost = document.createElement('div');
                newPost.innerHTML = `
        <div class="w-140 flex flex-col pb-4 pt-2 bg-[#2F2B2E] rounded-lg shadow-lg gap-4" id="postContainer">
            <div class="px-4 flex flex-col">
                <div class="flex justify-between">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="./png/profile_dummy.png" alt="profile" class="h-[50px]" />
                        <div class="flex flex-col text-white">
                            <span class="font-semibold text-lg">${data.author}</span>
                            <span class="text-sm text-gray-300">${data.timestamp}</span>
                        </div>
                    </div>
                    <svg class="deletePost hover:scale-110 transition-all cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 14.122L17.303 19.425C17.5844 19.7064 17.966 19.8645 18.364 19.8645C18.7619 19.8645 19.1436 19.7064 19.425 19.425C19.7064 19.1436 19.8645 18.7619 19.8645 18.364C19.8645 17.966 19.7064 17.5844 19.425 17.303L14.12 12L19.424 6.69699C19.5632 6.55766 19.6737 6.39226 19.749 6.21024C19.8244 6.02821 19.8631 5.83313 19.8631 5.63613C19.8631 5.43914 19.8242 5.24407 19.7488 5.06209C19.6733 4.8801 19.5628 4.71475 19.4235 4.57549C19.2841 4.43622 19.1187 4.32576 18.9367 4.25042C18.7547 4.17507 18.5596 4.13631 18.3626 4.13636C18.1656 4.13641 17.9706 4.17526 17.7886 4.25069C17.6066 4.32612 17.4412 4.43666 17.302 4.57599L12 9.87899L6.69697 4.57599C6.55867 4.43266 6.3932 4.31831 6.21024 4.23961C6.02727 4.16091 5.83046 4.11944 5.63129 4.11762C5.43212 4.11579 5.23459 4.15365 5.05021 4.22899C4.86583 4.30432 4.6983 4.41562 4.55739 4.55639C4.41649 4.69717 4.30503 4.86459 4.22952 5.0489C4.15401 5.23321 4.11597 5.43071 4.1176 5.62988C4.11924 5.82905 4.16053 6.02589 4.23905 6.20894C4.31758 6.39198 4.43177 6.55755 4.57497 6.69599L9.87997 12L4.57597 17.304C4.43277 17.4424 4.31858 17.608 4.24005 17.791C4.16153 17.9741 4.12024 18.1709 4.1186 18.3701C4.11697 18.5693 4.15501 18.7668 4.23052 18.9511C4.30603 19.1354 4.41749 19.3028 4.55839 19.4436C4.6993 19.5844 4.86683 19.6957 5.05121 19.771C5.23559 19.8463 5.43312 19.8842 5.63229 19.8824C5.83146 19.8805 6.02827 19.8391 6.21124 19.7604C6.3942 19.6817 6.55967 19.5673 6.69797 19.424L12 14.122Z"
                            fill="red" />
                    </svg>
                </div>
                <div class="text-white">
                    <p class="max-w-full break-words">${data.content}</p>
                </div>
            </div>
            <div class="bg-white w-full h-0.5"></div>
            <div class="flex justify-between items-center px-28 w-full">
                <div class="flex gap-2 items-center">
                    <svg class="cursor-pointer like hover:scale-110 transition-all" 
                        xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30" fill="none">
                        <path
                            d="M29.25 12.5C29.25 11.837 28.9866 11.2011 28.5178 10.7322C28.0489 10.2634 27.413 10 26.75 10H18.85L20.05 4.2875C20.075 4.1625 20.0875 4.025 20.0875 3.8875C20.0875 3.375 19.875 2.9 19.5375 2.5625L18.2125 1.25L9.9875 9.475C9.525 9.9375 9.25 10.5625 9.25 11.25V23.75C9.25 24.413 9.51339 25.0489 9.98223 25.5178C10.4511 25.9866 11.087 26.25 11.75 26.25H23C24.0375 26.25 24.925 25.625 25.3 24.725L29.075 15.9125C29.1875 15.625 29.25 15.325 29.25 15V12.5ZM1.75 26.25H6.75V11.25H1.75V26.25Z"
                            fill="white" />
                    </svg>
                    <p class="text-white text-base likeCount">${0}</p>
                </div>
                <svg class="cursor-pointer comment" xmlns="http://www.w3.org/2000/svg" width="31" height="30"
                    viewBox="0 0 31 30" fill="none">
                    <path
                        d="M27.9875 5C27.9875 3.625 26.875 2.5 25.5 2.5H5.5C4.125 2.5 3 3.625 3 5V20C3 21.375 4.125 22.5 5.5 22.5H23L28 27.5L27.9875 5ZM21.75 17.5H9.25C8.5625 17.5 8 16.9375 8 16.25C8 15.5625 8.5625 15 9.25 15H21.75C22.4375 15 23 15.5625 23 16.25C23 16.9375 22.4375 17.5 21.75 17.5ZM21.75 13.75H9.25C8.5625 13.75 8 13.1875 8 12.5C8 11.8125 8.5625 11.25 9.25 11.25H21.75C22.4375 11.25 23 11.8125 23 12.5C23 13.1875 22.4375 13.75 21.75 13.75ZM21.75 10H9.25C8.5625 10 8 9.4375 8 8.75C8 8.0625 8.5625 7.5 9.25 7.5H21.75C22.4375 7.5 23 8.0625 23 8.75C23 9.4375 22.4375 10 21.75 10Z"
                        fill="white" />
                </svg>
            </div>
        </div>
    `;
                const likeIcon = newPost.querySelector(".like");
                const deleteIcon = newPost.querySelector(".deletePost");

                likeIcon.addEventListener("click", () => {
                    const likeCountElem = likeIcon.parentElement.querySelector('.likeCount');
                    like(data.authorId, data.postId, likeCountElem);
                })

                deleteIcon.addEventListener("click", () => {
                    const post = document.getElementById('postContainer');
                    deletePost(data.postId, post);
                })

                postContainer.prepend(newPost);
                textarea.value = '';
                adjustHeight();

            } catch (err) {
                console.error(err);
                alert('Gagal membuat post.');
            }
        });

        const like = async (userId, postId, likeElement) => {
            try {
                const res = await fetch(`/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ userId, postId })
                });

                if (!res.ok) {
                    console.log(res);
                    throw new Error('Gagal menyukai post');
                }

                const data = await res.json();

                likeElement.textContent = data.likes;
            } catch (err) {
                console.error(err);
            }
        };

        const deletePost = async (postId,post) => {
            try {
                const res = await fetch(`/post/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (!res.ok) {
                    console.log(res);
                    throw new Error('Gagal menghapus post');
                }

                const data = await res.json();

                post.remove();
            } catch (err) {
                console.error(err);
            }
        }


        document.querySelectorAll('.deletePost').forEach((deleteIcon) => {
            deleteIcon.addEventListener('click', () => {
                const post = deleteIcon.parentElement.parentElement.parentElement;
                const postId = deleteIcon.dataset.postId;
                deletePost(postId,post);
            });
        });

        document.querySelectorAll('.like').forEach((likeIcon) => {
            likeIcon.addEventListener('click', () => {
                const userId = likeIcon.dataset.userId;
                const postId = likeIcon.dataset.postId;
                const likeCountElem = likeIcon.parentElement.querySelector('.likeCount');

                like(userId, postId, likeCountElem);
            });
        });

    </script>
@endsection