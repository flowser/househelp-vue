

<script>
  export default {
      mounted(){
        //   this.$store.dispatch( "permissions")
        // this.$store.dispatch( "roles")

      },
      computed:{

      },
    methods: {
        $hasrole(roleName) {
            let Roles = this.$store.getters.UserRoles;
            if(Array.isArray(roleName) == true){
                    return roleName.some(ele => Roles.includes(ele))
            }else{
                return Roles.indexOf(roleName) !== -1;
            }

        },
        $can(permissionName) {
            let Permissions = this.$store.getters.UserPermissions;
            if(Array.isArray(permissionName) == true){
                    return permissionName.some(ele => Permissions.includes(ele))
            }else{
                return Permissions.indexOf(permissionName) !== -1;
            }
        },
    },
  };
</script>
