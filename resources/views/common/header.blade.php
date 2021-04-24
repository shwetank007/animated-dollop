<div class="header">
  <a href="{{ route('search.index') }}" class="logo">Search Platform</a>
  <div class="header-right">
    <a class="{{ request()->route()->getName() === 'search.index' ? 'active' : '' }}" href="{{ route('search.index') }}">Home</a>
    <a class="{{ request()->route()->getName() === 'search.create' ? 'active' : '' }}" href="{{ route('search.create') }}">Add URL</a>
    <a class="{{ request()->route()->getName() === 'search.list' ? 'active' : '' }}" href="{{ route('search.list') }}">Search</a>
  </div>
</div>