

<script>
  export default {
    methods: {
      $hasrole(roleName) {
        return Roles.indexOf(roleName) !== -1;
      },
      $can(permissionName) {
        return Permissions.indexOf(permissionName) !== -1;
      },
    },
  };
</script>
