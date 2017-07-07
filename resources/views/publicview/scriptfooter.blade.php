	<script src="{{URL::asset('js/jquery.min.js') }}"></script>
	<script src="{{URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{URL::asset('js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{URL::asset('js/price-range.js') }}"></script>
    <script src="{{URL::asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{URL::asset('js/main.js') }}"></script>
    <script src="{{URL::asset('js/validator.min.js') }}"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#inquiryform').submit(function(event) {
						event.preventDefault();

		        var formData = {
		            'interest'          : $('input[name=interest]').val(),
		            'email'             : $('input[name=email]').val(),
		            'country'    				: $('input[name=country]').val(),
								'product_name'    	: $('input[name=product_name]').val()
		        };

		        // process the form
		        $.ajax({
		            type        : 'POST',
		            url         : "{{url('user-inquiry')}}",
		            data        : formData, //sending data object
		            dataType    : 'json', // what type of data do we expect back from the server
		            encode      : true
		        })
		        .done(function(data) {
		              //console.log(data);
		        });

						$img = "{{URL::asset('images/checkbox.png')}}";

						$('#inquiryform').html('<h1 style="font-size: 30px; margin-top: 50px;"><img width="100px" style="padding-right: 10px;" src="'+$img+'"/>Your Inquiry Sent Successfully.</h1> ')
						return false;
		    });
			});
		</script>

    <script>
    	$(document).ready(function(e){
		    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		        e.preventDefault();
		        var param = $(this).attr("href").replace("#","");
		        var concept = $(this).text();
		        $('.search-panel span#search_concept').text(concept);
		        $('.input-group #search_param').val(concept);

		    });

				if($('.carousel'))
				{
						$('.left').hide();
						$('.right').hide();

						$(document).on('mouseenter','.carousel',function(){
								$(this).find('.left').fadeIn();
								$(this).find('.right').fadeIn();
						});

						$(document).on('mouseleave','.carousel',function(){
								$(this).find('.left').fadeOut();
								$(this).find('.right').fadeOut();
						});
				}
		});
    </script>
