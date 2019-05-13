<template>
  <div id=menu-block>       
      <div class="footer-top">
			<div class="container" style="width: 100%;">
				<div class="row">
					<div class="col-sm-2">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="themes/eshopper/images/home/iframe1.png" alt="" />
								</div>								
							</a>
							<p>{{User}}</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="themes/eshopper/images/home/iframe1.png" alt="" />
									</div>									
								</a>
								<p>About US</p>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="themes/eshopper/images/home/iframe2.png" alt="" />
									</div>									
								</a>
								<p>Sevices</p>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="themes/eshopper/images/home/iframe3.png" alt="" />
									</div>									
								</a>
								<p>Features</p>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="themes/eshopper/images/home/iframe4.png" alt="" />
									</div>									
								</a>
								<p>Contacts</p>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="themes/eshopper/images/home/iframe4.png" alt="" />
								</div>								
							</a>
							<p>Contacts</p>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>

</template>


<script>
    export default {
        name:"Full-Event",
        data(){
            return{
                linkform:new Form({
                referralCourse_id:'',
                }),
                shareform:new Form({
                refferallink_id:'',
                url:'',
                network:'',
                }),
                imageUrl:'',
                enrollform: new Form({
                        id:'',
                        name:'',
                        regular_fee:'',
                        parttime_fee:'',
                        courseType:'',
                }),
                transactionform: new Form({
                        image:'',
                        transaction_code:'',
                         cartItems:'',
                }),
           }
        },
        mounted(){
            // this.$root.$on('social_shares_open', (network, url) =>this.Share(network, url));
            this.loadOrganisation();
            this.fetchUser();            
        },
        computed:{
            Organisation(){
                return this.$store.getters.Organisation
            },
            User(){
                return this.$store.getters.LoggedUser
            },            
        },
        methods:{ 
            fetchUser(){
                this.$store.dispatch('getUserRoles')
            },           
            certLoadImage(cert_certificate_image){
                if(cert_certificate_image){
                    return "/assets/organisation/img/affiliates/certs/"+cert_certificate_image;
                }else{
                    return "/assets/organisation/img/website/empty.png";
                }
            },
            
        },
    }
</script>


