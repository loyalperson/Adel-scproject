<!--begin::Card widget 20-->
<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #F1416C;background-image:url('assets/media/patterns/vector-1.png')">
	<!--begin::Header-->
	<div class="card-header pt-5">
		<form method="POST" action="{{ route('updateQuotas') }}">
			@csrf
			<!-- Quota 1 -->
			<div class="card-title d-flex flex-column">
				<!-- Amount Input -->
				<input type="number" name="quota1" class="form-control" value="{{ config('quotas.quota1') }}" />
				<!-- Subtitle -->
				<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Beginner Plan</span>
			</div>

			<!-- Quota 2 -->
			<div class="card-title d-flex flex-column">
				<!-- Amount Input -->
				<input type="number" name="quota2" class="form-control" value="{{ config('quotas.quota2') }}" />
				<!-- Subtitle -->
				<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Intermediate Plan</span>
			</div>

			<!-- Submit Button -->
			<button type="submit">Update</button>
		</form>
		<!--end::Quota-->
		<!--begin::Quota-->
		<div class="card-title d-flex flex-column">
			<!--begin::Amount-->
			<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">Contact Whatsapp</span>
			<!--end::Amount-->
			<!--begin::Subtitle-->
			<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Advanced Plan</span>
			<!--end::Subtitle-->
		</div>
		<!--end::Quota-->
	</div>
</div>
<!--end::Card widget 20-->
