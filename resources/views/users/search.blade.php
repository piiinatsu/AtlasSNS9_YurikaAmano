<x-login-layout>
  <h1>ユーザー検索</h1>
  <form action="{{ route('users.search_result') }}" method="GET">
    <input type="text" name="keyword" placeholder="ユーザー名検索">
    <button type="submit">検索</button>
  </form>
</x-login-layout>
