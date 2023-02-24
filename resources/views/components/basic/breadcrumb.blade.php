@props(['title'])

<h4 class="fw-bold py-3 mb-4 w-100">
    <span class="text-dark fw-light">{{$title}}</span>
    <a href="{{request()->url}}" class="float-end" title="Refresh">
        <i class="menu-icon bx bx-refresh"></i>
    </a>
</h4>