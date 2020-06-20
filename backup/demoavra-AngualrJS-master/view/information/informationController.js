'use strict';

deskControllers.controller('informationController', ['$scope', '$window', '$cookies', '$location', 'getinfromation', 'getuserconfrom', 'gcmgetid', '$http',
    function ($scope, $window, $cookies, $location, getinfromation, getuserconfrom,gcmgetid,$http) {

        $(".loader").fadeIn();
        var userData = $cookies.getObject('userData');
        var gcmid = "";
        $scope.userId = userData.USER_ID;
        $scope.selectTime = ['Time','Remote Work'];
        //console.log('Information userData : ' +JSON.stringify(userData));
        //$scope.gcm_id = "cjLBht7yrWM:APA91bGXWFMabtgQYg9Nn_PYtYMbVnvco4-QRVIX_e-f0B3hxsB9PB2E6ksqLLevNDOj7PBBcTFImNffhNhniEjCfj63dXKZC3c47glywXDe9RPmjY7zXbW3olOETXTZqvIo3iYThdqZ";
        var searchObject = $location.search();
        $scope.USER_NAME = searchObject.USER_NAME;
        $scope.USER_ID  = searchObject.USER_ID;
        $scope.STR_DATE = searchObject.STR_DATE;
        $scope.END_DATE = searchObject.END_DATE;
        $scope.userName = $scope.USER_NAME;
        console.log('Information userID : ' +JSON.stringify($scope.userId));

        getinfromation.get(
            {
                USER_ID: $scope.USER_ID,
                STR_DATE: $scope.STR_DATE,
                END_DATE: $scope.END_DATE
            }, function (response) {
                //$(".loader").fadeIn();
                //console.log('Get Information : ' +JSON.stringify(response));
                gcmid = response.data.GCM_ID.GCMID;
                  console.log("R GCM : "+JSON.stringify(gcmid));
                if(response.status == 1){
                    $(".loader").fadeOut();
                    $scope.getInformation = response.data;
                    $.toaster(response.msg, 'Congratulation', 'success');
                    //console.log('Get Information : ' +JSON.stringify($scope.getInformation));
                }
                else{
                    $(".loader").fadeOut();
                    $scope.msg = "Not Data Avialable...";
                    $.toaster(response.msg, 'Alert', 'warning');
                }
        },function(){
                $.toaster("Connection Problem ", 'Alert', 'danger');
        });

        getuserconfrom.get(
            {
                USER_ID: $scope.USER_ID,
                STR_DATE: $scope.STR_DATE,
                END_DATE: $scope.END_DATE
            }, function (response) {
                //$(".loader").fadeIn();
                console.log('Get Confromation : ' +JSON.stringify(response));
                if(response.status == 1){
                    $(".loader").fadeOut();
                    $scope.getUserConfrom = response.data;
                   // $.toaster(response.msg, 'Congratulation', 'success');
                    //console.log('Get Confromation : ' +JSON.stringify($scope.getUserConfrom));
                }
                else{
                    $(".loader").fadeOut();
                    $scope.msg = "Not Data Avialable...";
                    $.toaster(response.msg, 'Alert', 'warning');
                }
            },function(){
                $.toaster("Connection Problem ", 'Alert', 'danger');
            });
//-----------------------------------------------------------------------------function
        $scope.gcmFunction = function(){
          console.log("gcm_id : "+gcmid);
          console.log("msg : "+JSON.stringify($scope.message));
          console.log("time : "+JSON.stringify($scope.select));
          //http://demoavra.eu/api/sendgcm.php?gcm_id=cjLBht7yrWM:APA91bGXWFMabtgQYg9Nn_PYtYMbVnvco4-QRVIX_e-f0B3hxsB9PB2E6ksqLLevNDOj7PBBcTFImNffhNhniEjCfj63dXKZC3c47glywXDe9RPmjY7zXbW3olOETXTZqvIo3iYThdqZ&message=testing&time=Time
          $scope.url = 'http://localhost:8081/Projects/demoavra/api/sendgcm.php?gcm_id='+gcmid+'&message='+$scope.message+'&time='+$scope.select
               $http.post($scope.url)
                .success(function(response) {
                    $scope.message = "";
                    //$scope.select = "";
                    //alert("success")
                  })
                  .error(function() { //alert("fail")
                });
            /*gcmgetid.save(
            {
                    gcm_id:gcmid || "no GCM",
                    message:$scope.message || "no message",
                    time: $scope.select || ""
            }, function (response) {

                },function(){
                    $.toaster("Connection Problem ", 'Alert', 'danger');
                });*/
        }
    }]);
