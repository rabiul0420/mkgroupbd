@extends('admin.layouts.app')
@section('title','Website Settings')
@push('css')
    
@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Website Settings</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <x-alert-component />
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-website-settings') }}" class="form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Company Name {!! starSign() !!}</label>
                                        <input type="text" name="company_name" value="{{ old('company_name') ?? siteSetting()['company_name'] ?? '' }}" class="form-control {!! hasError('company_name') !!}" placeholder="Company Name" />
                                        @error('company_name')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Email {!! starSign() !!}</label>
                                        <input type="text" name="email" value="{{ old('email') ?? siteSetting()['email'] ?? '' }}" class="form-control {!! hasError('email') !!}" placeholder="Email" />
                                        @error('email')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Mobile {!! starSign() !!}</label>
                                        <input type="text" name="mobile" value="{{ old('mobile') ?? siteSetting()['mobile'] ?? '' }}" class="form-control {!! hasError('mobile') !!}" placeholder="mobile" />
                                        @error('mobile')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Phone {!! starSign() !!}</label>
                                        <input type="text" name="phone" value="{{ old('phone') ?? siteSetting()['phone'] ?? '' }}" class="form-control {!! hasError('phone') !!}" placeholder="Phone" />
                                        @error('phone')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" name="fax" value="{{ old('fax') ?? siteSetting()['fax'] ?? '' }}" class="form-control {!! hasError('fax') !!}" placeholder="Fax" />
                                        @error('fax')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control p-0 {!! hasError('address') !!}" cols="30" rows="1" placeholder="Address">{{ old('address') ?? siteSetting()['address'] ?? '' }}</textarea>
                                        @error('address')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Site Slogan {!! starSign() !!}</label>
                                        <input type="text" name="site_slogan" value="{{ old('site_slogan') ?? siteSetting()['site_slogan'] ?? '' }}" class="form-control {!! hasError('site_slogan') !!}" placeholder="Site Slogan" />
                                        @error('site_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>About Us Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="about_us_section_slogan" value="{{ old('about_us_section_slogan') ?? siteSetting()['about_us_section_slogan'] ?? '' }}" class="form-control {!! hasError('about_us_section_slogan') !!}" placeholder="About Us Section Slogan" />
                                        @error('about_us_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Service Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="service_section_slogan" value="{{ old('service_section_slogan') ?? siteSetting()['service_section_slogan'] ?? '' }}" class="form-control {!! hasError('service_section_slogan') !!}" placeholder="Service Section Slogan" />
                                        @error('service_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Event Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="event_section_slogan" value="{{ old('event_section_slogan') ?? siteSetting()['event_section_slogan'] ?? '' }}" class="form-control {!! hasError('event_section_slogan') !!}" placeholder="Event Section Slogan" />
                                        @error('event_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Team Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="team_section_slogan" value="{{ old('team_section_slogan') ?? siteSetting()['team_section_slogan'] ?? '' }}" class="form-control {!! hasError('team_section_slogan') !!}" placeholder="Team Section Slogan" />
                                        @error('team_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>FAQ Slogan {!! starSign() !!}</label>
                                        <input type="text" name="faq_section_slogan" value="{{ old('faq_section_slogan') ?? siteSetting()['faq_section_slogan'] ?? '' }}" class="form-control {!! hasError('faq_section_slogan') !!}" placeholder="FAQ Slogan" />
                                        @error('faq_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Contact Us Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="contact_us_section_slogan" value="{{ old('contact_us_section_slogan') ?? siteSetting()['contact_us_section_slogan'] ?? '' }}" class="form-control {!! hasError('contact_us_section_slogan') !!}" placeholder="Contact Us Section Slogan" />
                                        @error('contact_us_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Client Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="client_section_slogan" value="{{ old('client_section_slogan') ?? siteSetting()['client_section_slogan'] ?? '' }}" class="form-control {!! hasError('client_section_slogan') !!}" placeholder="Client Section Slogan" />
                                        @error('client_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Newsletter Section Slogan {!! starSign() !!}</label>
                                        <input type="text" name="newsletter_section_slogan" value="{{ old('newsletter_section_slogan') ?? siteSetting()['newsletter_section_slogan'] ?? '' }}" class="form-control {!! hasError('newsletter_section_slogan') !!}" placeholder="Newsletter Section Slogan" />
                                        @error('newsletter_section_slogan')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Company Youtube Video Link</label>
                                        <input type="text" name="youtube_video_link" value="{{ old('youtube_video_link') ?? siteSetting()['youtube_video_link'] ?? '' }}" class="form-control {!! hasError('youtube_video_link') !!}" placeholder="Company Youtube Video Link" />
                                        @error('youtube_video_link')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input type="text" name="facebook_url" value="{{ old('facebook_url') ?? siteSetting()['facebook_url'] ?? '' }}" class="form-control {!! hasError('facebook_url') !!}" placeholder="Facebook URL" />
                                        @error('facebook_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Linkedin URL</label>
                                        <input type="text" name="linkedin_url" value="{{ old('linkedin_url') ?? siteSetting()['linkedin_url'] ?? '' }}" class="form-control {!! hasError('linkedin_url') !!}" placeholder="Linkedin URL" />
                                        @error('linkedin_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Twitter URL</label>
                                        <input type="text" name="twitter_url" value="{{ old('twitter_url') ?? siteSetting()['twitter_url'] ?? '' }}" class="form-control {!! hasError('twitter_url') !!}" placeholder="Twitter URL" />
                                        @error('twitter_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Instagram URL</label>
                                        <input type="text" name="instagram_url" value="{{ old('instagram_url') ?? siteSetting()['instagram_url'] ?? '' }}" class="form-control {!! hasError('instagram_url') !!}" placeholder="Instagram URL" />
                                        @error('instagram_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Google Map URL{!! starSign() !!}</label>
                                        <input type="text" name="google_map_url" value="{{ old('google_map_url') ?? siteSetting()['google_map_url'] ?? '' }}" class="form-control {!! hasError('google_map_url') !!}" placeholder="Google Map URL" />
                                        @error('google_map_url')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>About Us {!! starSign() !!}</label>
                                        <textarea name="about_us" id="about_us" class="form-control" cols="30" rows="10">{{ old('about_us') ?? siteSetting()['about_us'] ?? '' }}</textarea>
                                        @error('about_us')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Mission and Vission {!! starSign() !!}</label>
                                        <textarea name="mission_vission" id="mission_vission" class="form-control" cols="30" rows="10">{{ old('mission_vission') ?? siteSetting()['mission_vission'] ?? '' }}</textarea>
                                        @error('mission_vission')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Privacy Policy {!! starSign() !!}</label>
                                        <textarea name="privacy_policy" id="privacy_policy" class="form-control" cols="30" rows="10">{{ old('privacy_policy') ?? siteSetting()['privacy_policy'] ?? '' }}</textarea>
                                        @error('privacy_policy')
                                        {!! displayError($message) !!}
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 text-right">
                                    <x-submit-button-component />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
    CKEDITOR.replace( 'about_us', {
        removePlugins: ['info','image'],
   });
    CKEDITOR.replace( 'mission_vission', {
        removePlugins: ['info','image'],
   });
    CKEDITOR.replace( 'privacy_policy', {
        removePlugins: ['info','image'],
   });
</script>
@endpush