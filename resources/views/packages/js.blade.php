<script>
        
        /*! jQuery visible 1.0.0 teamdf.com/jquery-plugins | teamdf.com/jquery-plugins/license */
        (function(d){d.fn.visible=function(e,i){var a=d(this).eq(0),f=a.get(0),c=d(window),g=c.scrollTop();c=g+c.height();var b=a.offset().top,h=b+a.height();a=e===true?h:b;b=e===true?b:h;return!!(i===true?f.offsetWidth*f.offsetHeight:true)&&b<=c&&a>=g}})(jQuery);

        $(document).ready(function(){  
            // Get the modal
            

            $('.example').click(function(e){
                e.preventDefault();
                $('#myModal').show();
                $("#img01").attr('src',$(this).data('src'));
                $("#caption").html($(this).data('caption'));
            });

            $('.close').click(function() { 
                $('#myModal').hide();
            });
            
            

            var total = 0;
            $('.radio:checked').each(function(){
                console.log($(this));
                total += $(this).data('price');
            });
            $("#total").val(total);

            window.scrollTo(0, 0);
            $(window).scroll(function(){
                @for ($i = 0; $i < count(isset($packages)? $packages : (isset($package)? $package->options: 0)); $i++)
                if($('#{{$i}}').visible(true)){$('#{{$i}}').addClass('open');}
                if(!$('#{{$i}}').visible(true)){$('#{{$i}}').removeClass('open');}
                @endfor
                
                if($('#budget').visible(true)){$('#budget').addClass('open');}
                if(!$('#budget').visible(true)){$('#budget').removeClass('open');}

                if($('#enquire').visible(true)){$('#enquire').addClass('open');}
                if(!$('#enquire').visible(true)){$('#enquire').removeClass('open');}
            });
            $('a').click(function(){
                $('html, body').animate({
                    scrollTop: $( $.attr(this, 'href') ).offset().top - 150
                }, 500);
                return false;
            });  
            
            $('body').on('click','.radio',function(e){
                
                var total = 0;
                $('.radio:checked').each(function(){
                    total += $(this).data('price');
                });
                $("#total").val(total);
            });

           
            
        });
    </script>
