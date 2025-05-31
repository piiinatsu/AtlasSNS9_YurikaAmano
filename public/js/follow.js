document.addEventListener('DOMContentLoaded', function () {
  const followArea = document.getElementById('followArea');

  if (followArea) {
    followArea.addEventListener('submit', function (e) {
      e.preventDefault();

      const form = e.target;
      const action = form.action;
      const formData = new FormData(form);

      fetch(action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          // ① フォローボタンの部分を更新
          document.getElementById('followArea').innerHTML = data.html;

          // ② サイドバーのフォロー数を更新
          const sidebarFollowCount = document.getElementById('sidebar-follow-count');
          if (sidebarFollowCount && data.followCount !== undefined) {
            sidebarFollowCount.textContent = `${data.followCount}人`;
          }

          // ③ サイドバーのフォロワー数も更新
          const sidebarFollowerCount = document.getElementById('sidebar-follower-count');
          if (sidebarFollowerCount && data.followerCount !== undefined) {
            sidebarFollowerCount.textContent = `${data.followerCount}人`;
          }
        })
        .catch(error => {
          console.error('通信エラー:', error);
        });
    });
  }
});
