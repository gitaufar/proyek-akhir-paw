<?php
// app/View/Components/PostCard.php
namespace App\View\Components;

use Illuminate\View\Component;

class PostCard extends Component
{
    /**
     * Nama penulis post.
     * @var string
     */
    public $postUserId;

    /**
     * Nama penulis post.
     * @var string
     */
    public $likes;

     /**
     * Nama penulis post.
     * @var string
     */
    public $comments;

    /**
     * Nama penulis post.
     * @var string
     */
    public $userId;

    /**
     * Nama penulis post.
     * @var string
     */
    public $postId;
    /**
     * Nama penulis post.
     * @var string
     */
    public $author;

    /**
     * Konten dari post.
     * @var string
     */
    public $content;

    /**
     * Waktu post dibuat.
     * @var string
     */
    public $timestamp;

    /**
     * Buat instance komponen baru.
     *
     * @param string $author
     * @param string $content
     * @param string $timestamp
     * @return void
     */
    public function __construct($postUserId,$likes,$comments,$userId,$postId,$author, $content, $timestamp)
    {
        $this->comments = $comments;
        $this->postUserId = $postUserId;
        $this->likes = $likes;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->author = $author;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    /**
     * Dapatkan view / konten yang merepresentasikan komponen.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-card');
    }
}