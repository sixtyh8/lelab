'use strict'

describe 'Controller: CreditsctrlCtrl', () ->

  # load the controller's module
  beforeEach module 'leLabApp'

  CreditsctrlCtrl = {}
  scope = {}

  # Initialize the controller and a mock scope
  beforeEach inject ($controller, $rootScope) ->
    scope = $rootScope.$new()
    CreditsctrlCtrl = $controller 'CreditsctrlCtrl', {
      $scope: scope
    }

  # it 'should attach a list of awesomeThings to the scope', () ->
  #   expect(scope.awesomeThings.length).toBe 3
