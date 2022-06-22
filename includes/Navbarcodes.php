
<style>
        .sidenav {
          height: 100%;
          margin-top: 0px;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          left: 0;
          background-color: #442814;
          overflow: auto;
          transition: 0.5s;
          padding-top: 60px;
        }
        
        .sidenav a {
          padding: 8px 8px 8px 32px;
          text-decoration: none;
          font-size: 18px;
          font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
          color: #fff;
          display: block;
          transition: 0.3s;

        }
        
        .sidenav a:hover {
          color: #FEA47F;
          background-color: #fff ;
          border-radius: 6px;
          border-style: solid;
          transition: 0.5s;

          
        }
        
        .sidenav .closebtn {
          position: absolute;
          top: 0;
          right: 25px;
          font-size: 24px;
          margin-left: 50px;
        }
        
        #main 
        {
          transition: margin-left .5s;
          padding: 16px;
        }
        
        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }
        .center {
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;
        }
        </style>
   
   
      <script>
        function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
          document.getElementById("main").style.marginLeft = "250px";
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
        }
        </script>
