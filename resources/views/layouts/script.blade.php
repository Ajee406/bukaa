@if(session('payment_form_html'))
    <div id="virtualPaymentForm" style="display: none;">
        {!! session('payment_form_html') !!}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Find the form inside the hidden div and submit it automatically
            var virtualForm = document.getElementById('virtualPaymentForm').querySelector('form');
            if (virtualForm) {
                virtualForm.submit();
            }
        });
    </script>
@endif

<!-- js file  -->
<script src="{{ asset('assets/js/jquery-3.7.0.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins.js')}}"></script>
<script src="{{ asset('assets/js/dataTables.js')}}"></script>
<script src="{{ asset('assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/css/summernote/summernote-lite.min.js') }}"></script>
<script src="{{ asset('assets/js/lc_select.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js')}}?ver={{ env('VERSION', 0) }}"></script>
<script src="{{ asset('common/js/common.js')}}?ver={{ env('VERSION' ,0) }}"></script>

@stack('script')

<style>
    @if(isAddonInstalled('ALUSAAS') && isCentralDomain())
        {{ getOption('sa_custom_css') }}
    @else
        {{ getOption('custom_css') }}
    @endif
</style>

<script>
	var currencySymbol = "{{ getCurrencySymbol() }}";
	var currencyPlacement = "{{ getCurrencyPlacement() }}";

	@if(Session::has('success'))
	toastr.success("{{ session('success') }}");
	@endif
	@if(Session::has('error'))
	toastr.error("{{ session('error') }}");
	@endif
	@if(Session::has('info'))
	toastr.info("{{ session('info') }}");
	@endif
	@if(Session::has('warning'))
	toastr.warning("{{ session('warning') }}");
	@endif

	@if (@$errors->any())
	@foreach ($errors->all() as $error)
	toastr.error("{{ $error }}");
	@endforeach
	@endif
</script>
