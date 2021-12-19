 

  <!-- The Modal -->
  <div class="modal fade" id="myModal1" >
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">السعر</h4>
          <button type="button" class="close" data-dismiss="modal" style="margin-left: 0px;">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit aut nobis unde, at omnis minus natus
          exercitationem quibusdam eaque sed quidem similique? Sed ipsa natus veritatis beatae commodi tempore dolores?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success">إرسال</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          
        </div>

      </div>
    </div>
  </div>
  <!-- -------------------------------------------------- -->

    <div class="container-fluid ">
    
    <footer style="max-width: 100%; text-align: center; color: white; margin-bottom: 5px;">
      <div class="  border-primary  bg-dark rounded-top h-auto ">
      <span style="font-size: 3vw;">COPYRIGHT <?php  echo date('Y/M/D'); ?> &copy;  AL-SHARAFI</span>
			<ul type='none' class="col-sm-12 ">
				<li><a href='#'><img  src='../imges/facebook_color.png' alt='facebook'></a></li>
				<li><a href='#'><img  src='../imges/youtube_color.png' alt='youtube'></a></li>
				<li><a href='#'><img  src='../imges/i_color.png' alt='i'></a></li>
				<li><a href='#'><img  src='../imges/twitter_color.png' alt='twitter'></a></li>
				<li><a href='#'><img  src='../imges/in_color.png' alt='in'></a></li>
				<li><a href='#'><img  src='../imges/google_color.png' alt='google+'></a></li>
			</ul>
      </div>



    </footer>


  </div>
 

 
  <script>

    $(document).ready(function () {
      $(".btn-warning").click(function () {
        $("#myModal1").modal("show");
      });
    });
  </script>

</body>  

</html>