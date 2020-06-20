'use strict';

deskServices.factory('login',['$resource','webAppConstant',
    function($resource,webAppConstant){
        return $resource(webAppConstant + 'checklogin.php', {USER_NAME:'@USER_NAME', USER_COMPANY_NAME:'@USER_COMPANY_NAME', USER_PASS:'@USER_PASS'}, {
            query: { method: "POST"}
        });
    }]);

deskServices.factory('getinfromation',['$resource','webAppConstant',
    function($resource,webAppConstant){
        return $resource(webAppConstant + 'get_information.php', {USER_ID:'@USER_ID', STR_DATE:'@STR_DATE', END_DATE:'@END_DATE'}, {
            query: { method: "POST"}
        });
    }]);

deskServices.factory('getuserconfrom',['$resource','webAppConstant',
    function($resource,webAppConstant){
        return $resource(webAppConstant + 'get_user_confirmation.php', {USER_ID:'@USER_ID', STR_DATE:'@STR_DATE', END_DATE:'@END_DATE'}, {
            query: { method: "POST"}
        });
    }]);

deskServices.factory('recalculate',['$resource','webAppConstant',
    function($resource,webAppConstant){
        return $resource(webAppConstant + 'Recalculate.php', {STR_DATE:'@STR_DATE', END_DATE:'@END_DATE', DEFECTS:'@DEFECTS', DETECTED_HOURS:'@DETECTED_HOURS', SAP_LEVEL:'@SAP_LEVEL'}, {
            query: { method: "POST"}
        });
    }]);

deskServices.factory('teamperfrom',['$resource','webAppConstant',
        function($resource,webAppConstant){
            return $resource(webAppConstant + 'team_performance.php', {STR_DATE:'@STR_DATE', END_DATE:'@END_DATE'}, {
                query: { method: "POST"}
            });
        }]);

deskServices.factory('gcmgetid',['$resource','webAppConstant',
    function($resource,webAppConstant){
              return $resource(webAppConstant + 'sendgcm.php', {gcm_id:'@gcm_id',message:'@message',time:'@time'}, {
                        query: { method: "POST"}
                    });
                }]);
