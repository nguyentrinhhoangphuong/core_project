<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}</title>
<!-- CSS files -->
<link href="{{ asset('_admin/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('_admin/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('_admin/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('_admin/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
<link href="{{ asset('_admin/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />

<style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
</style>
