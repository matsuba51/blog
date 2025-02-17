document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("translate-x-0"); // メニューを表示/非表示に
            mobileMenu.classList.toggle("translate-x-full"); // メニューが画面外（右側）にスライドアウト
        });
    }
});

// コメント編集フォームの表示
function showEditForm(commentId) {
    document.getElementById(`edit-form-${commentId}`).classList.remove("hidden");
    document.getElementById(`comment-text-${commentId}`).classList.add("hidden");
}

// コメント編集フォームの非表示
function hideEditForm(commentId) {
    document.getElementById(`edit-form-${commentId}`).classList.add("hidden");
    document.getElementById(`comment-text-${commentId}`).classList.remove("hidden");
}
