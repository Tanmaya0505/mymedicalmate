<footer class="footer footer-light @if(isset($configData['footerType'])){{$configData['footerClass']}}@endif">
  <p class="clearfix mb-0">
    <span class="float-left d-inline-block">{{ date('Y') }} &copy; {{ env('APP_NAME') }}</span>
    <span class="float-right d-sm-inline-block d-none">Crafted with
      <i class="bx bxs-heart pink mx-50 font-small-3"></i>by
      <a class="text-uppercase" href="{{ env('APP_URL') }}" target="_blank">{{ env('APP_NAME') }}</a>
    </span>
    @if($configData['isScrollTop'] === true)
    <button class="btn btn-primary btn-icon scroll-top" type="button">
      <i class="bx bx-up-arrow-alt"></i>
    </button>
    @endif
  </p>
</footer>
