<style>
    /* ROW CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .row .span4 {
        text-align: center;
    }
    .row h3 {
        font-weight: normal;
    }
    .row .span4 p {
        margin-left: 10px;
        margin-right: 10px;
    }

    .nav-tabs a {
        font-size: 14px;
    }
</style>

<h2 style="margin-top: -30px">Create Assessment</h2>
<hr/>
<?php
$prev = "asm_info";
$next = "review_qa";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Assessment Info</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Review Q&A &rarr;</a>
    </li>
</ul>
<hr>
<!-- Script in AngularJS -->
<script src="http://code.angularjs.org/1.2.6/angular.min.js"></script>
<script type="text/javascript">
function FormController($scope) {
  var user = $scope.user = {
    name: 'John Smith',
    address:{line1: '123 Main St.', city:'Anytown', state:'AA', zip:'12345'},
    contacts:[{type:'phone', value:'1(234) 555-1212'}]
  };
  $scope.state = /^\w\w$/;
  $scope.zip = /^\d\d\d\d\d$/;
 
  $scope.addContact = function() {
     user.contacts.push({type:'email', value:''});
  };
 
  $scope.removeContact = function(contact) {
    for (var i = 0, ii = user.contacts.length; i < ii; i++) {
      if (contact === user.contacts[i]) {
        $scope.user.contacts.splice(i, 1);
      }
    }
  };
} 
</script>
<!-- HTML in AngularJS -->
<div ng-controller="FormController" class="qa_form">
    <label>Name:</label><br>
      <input type="text" ng-model="user.name" required/> <br><br>
    
      <label>Address:</label><br>
      <input type="text" ng-model="user.address.line1" size="33" required> <br>
      <input type="text" ng-model="user.address.city" size="12" required>,
      <input type="text" ng-model="user.address.state"
             ng-pattern="state" size="2" required>
      <input type="text" ng-model="user.address.zip" size="5"
             ng-pattern="zip" required><br><br>
    
      <label>Phone:</label>
      [ <a href="" ng-click="addContact()">add</a> ]
      <div ng-repeat="contact in user.contacts">
        <select ng-model="contact.type">
          <option>email</option>
          <option>phone</option>
          <option>pager</option>
          <option>IM</option>
        </select>
        <input type="text" ng-model="contact.value" required>
         [ <a href="" ng-click="removeContact(contact)">X</a> ]
      </div>
      <hr/>
      Debug View:
      <pre>user={{user | json}}</pre>
</div> <!--Division close of FormController-->
<hr>




