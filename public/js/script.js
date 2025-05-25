document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("editModal");
    const editButtons = document.querySelectorAll(".edit_btn");
    const editForm = document.getElementById("editForm");
    const editPostContent = document.getElementById("editPostContent");
    const editPostId = document.getElementById("editPostId");

  // モーダルの初期状態を非表示
    modal.style.display = "none";

  // 編集ボタンをクリックしたとき
    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            const postId = this.getAttribute("data-post-id");
            const postContent = this.getAttribute("data-post-content");

            editPostContent.value = postContent; // 投稿内容をセット
            editPostId.value = postId; // 投稿IDをセット
            editForm.setAttribute("action", `/posts/${postId}/update`); // 更新用のURLをセット
            modal.style.display = "block"; // モーダルを表示
        });
    });

  // フォーム送信時に `/posts/index` にリダイレクト
    editForm.addEventListener("submit", function(event) {
        event.preventDefault(); // デフォルトの送信を防ぐ

        fetch(editForm.getAttribute("action"), {
            method: "POST",
            body: new FormData(editForm),
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = "/posts/index"; // TOP にリダイレクト
            } else {
                alert("更新に失敗しました");
            }
        })
        .catch(error => console.error("エラー:", error));
    });

  // モーダル外をクリックすると閉じる
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
