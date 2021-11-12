<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c414f6c94e.js" crossorigin="anonymous"></script>

<script>
  var btncontainer = document.getElementById("header_middle_in");
  var btns = btncontainer.getElementsByClassName("header_option");
  
  for(var i = 0; i < btns.length; i++){
    btns[i].addEventListener('click', function(){
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active");
      this.className += " active";
    })
  }
</script>

</body>
</html>