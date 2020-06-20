'use strict';

deskControllers.controller('homeController', ['$scope', '$window', 'login', '$cookies',
    function ($scope, $window, login, $cookies) {

        $(".loader").fadeOut();

       $scope.loginFunction = function(){
           login.save(
               {
                   USER_NAME : $scope.userName,
                   USER_COMPANY_NAME : $scope.companyName,
                   USER_PASS : $scope.password
               }, function (response){
                   $(".loader").fadeIn();
                   console.log('Data :' +JSON.stringify(response));
                   if(response.status  == 1)
                   {
                       $(".loader").fadeOut();
                       $cookies.putObject('userData',response.data);
                       $.toaster(response.msg, 'Congratulation', 'success');
                       $window.location.href = "#/spacetree"
                   }
                   else{
                       $.toaster(response.msg, 'Alert', 'warning');
                       $window.location.href = "#/home"
                   }
           },function(){
                   $.toaster("Connection Problem ", 'Alert', 'danger');
           });
       };
    }]);