<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class DiskusiController extends Controller
{
    public function storePost(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        try {
            $post = Post::create([
                'user_id' => Auth::id(),
                'content' => trim($validatedData['content']),
            ]);

            return response()->json([
                'author' => Auth::user()->name,
                'content' => $post->content,
                'timestamp' => $post->created_at->format('d M Y, H:i'),
                'postId' => $post->id,
                'authorId' => Auth::id()
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat post: ' . $e->getMessage());
        }

    }

    public function postLike(Request $request)
    {
        $userId = $request->input('userId');
        $postId = $request->input('postId');

        $like = Like::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId,
            ]);
        }

        $likeCount = Like::where('post_id', $postId)->count();

        return response()->json(['likes' => $likeCount]);
    }

     public function deletePost($id) // <--- Ambil $id langsung dari parameter rute
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post tidak ditemukan.'], 404);
        }

        try {
            $post->delete();
            return response()->json(['message' => 'Post berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server saat menghapus post.'], 500);
        }
    }

}
