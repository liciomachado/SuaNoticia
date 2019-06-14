
<footer id="contato">
    <address>
        <strong>SuaNoticia.com - ME</strong><br>
        Maj Vieira, bloco 5. Sao Paulo,SP <br>
        tel:(11) 5571-2751 ou 5083-3884 <br>
    </address>

</footer>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
       (function(){
    // Executa quando o mouse estiver sobre
    jQuery("#whatever-gallery > div ").hover(function(){
        // com o mouse sobre
        jQuery(this).children("form").show();
    }, function(){
        // quando o mouse sai de cima
        jQuery(this).children("form").hide();
    });
    
})(jQuery);

</script>
</html>