<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="container">
        <div class="text-center my-5">
            <h1>404 未找到页面</h1>
            <a class="btn btn-primary" href="{{ route('home') }}">返回首页</a>
        </div>
    </div>
</x-app-layout>
