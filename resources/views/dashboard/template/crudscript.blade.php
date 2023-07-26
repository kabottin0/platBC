<script>
  $('document').ready(function () {
      $('.alert').fadeOut(5000);
      $('ul').on('click', 'a.btn-danger', function (ele) {
          ele.preventDefault();
          var urlArch = $(this).attr('href');
          var li = ele.target.parentNode.parentNode;

          $.ajax(urlArch,
              {                    
                  data:{_token:$('#_token').val()
                  },
                  complete : function (resp) {
                      console.log(resp);
                      if(resp.responseText == 1){
                       //   alert(resp.responseText)
                          li.parentNode.removeChild(li);
                          // $(li).remove();
                      } else {
                          alert('Problem contacting server');
                      }
                  }
              }
          )
      });

  });
</script>