@extends('master')
@section('title')
    {{ __('Contact') }}
@endsection
@section('content')
<div class="pages-hero">
    <div class="container">
        <div class="pages-title">
            <h1>Contact Us</h1>
            <p>Get In Touch</p>
        </div>
    </div>
</div>
    <!-- CONTENT START -->
    <section>
        <!-- CONTACT BOX START -->
        <div class="bg-wrapper contact-wrapper mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cw-box">
                            <div class="cw-circle">
                                <figure class="cw-icon">
                                    <img src="{{ asset('images/icons/placeholder.png') }}" alt="">
                                </figure>
                            </div>
                            <p>837 Castle Hill Ave. Bronx NY </p>
                            <p>33195 United States</p>
                        </div>
                    </div>
                    <div class="col-lg-4 spacing-m-center">
                        <div class="cw-box">
                            <div class="cw-circle">
                                <figure class="cw-icon">
                                    <img src="{{ asset('images/icons/telephone.png') }}" alt="">
                                </figure>
                            </div>
                            <p><a href="tel:718-825-3320"> 718-825-3320</a></p>
                            <p><a href="tel:212-632-4120"> 212-632-4120</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cw-box">
                            <div class="cw-circle">
                                <figure class="cw-icon">
                                    <img src="{{ asset('images/icons/email.png') }}" alt="">
                                </figure>
                            </div>
                            <p><a href="mailto:info@industric.com">info@industric.com</a></p>
                            <p><a href="mailto:sales@industra.com">sales@industra.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTACT BOX END -->

        <!-- CONTACT FORM START -->
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="contact-title">
                        <h3>Get in Touch With Us</h3>
                        <p>World’s leading non-asset- based supply chain management companies, we design and implement
                            industry-leading. We specialise in intelligent & effective search and believes business.</p>
                    </div>
                    <br />
                    <form id="contact-form" method="post" action="http://quickdevs.com/demo/industric/contact.php">
                        <div class="messages"></div>
                        <div class="controls">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input id="form_name" type="text" name="name" class="form-control custom-form"
                                            placeholder="*Name" required="required" data-error="Firstname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input id="form_email" type="email" name="email" class="form-control custom-form"
                                            placeholder="*Email address" required="required"
                                            data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input id="form_phone" type="tel" name="phone" class="form-control custom-form"
                                            placeholder="*Please enter your phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea id="form_message" name="message"
                                            class="form-control message-form custom-form" placeholder="*Your message"
                                            rows="6" required="required" data-error="Please,leave us a message."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-12 btn-send">
                                    <p><input type="submit" class="btn btn-default" value="Send message"></p>
                                </div>
                                <div class="col-sm-12">
                                    <p class="required">
                                        * These fields are required.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- CONTACT FORM END -->

        <!-- MAP START -->
        <div class="bottom-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d167616.99483399244!2d-74.08279002518668!3d40.67646407501496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a560db693e3%3A0xb05e8b0bdf854b54!2sGowanus%2C+Brooklyn%2C+Nueva+York%2C+EE.+UU.!5e0!3m2!1ses-419!2sdo!4v1560863423970!5m2!1ses-419!2sdo"
                class="map-iframe-alt"></iframe>
        </div>
        <!-- MAP END -->
    </section>
    <!-- CONTENT END -->
@endsection
