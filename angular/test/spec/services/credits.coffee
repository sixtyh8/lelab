'use strict'

describe 'Service: Credits', () ->

  # load the service's module
  beforeEach module 'leLabApp'

  # instantiate service
  Credits = {}
  beforeEach inject (_Credits_) ->
    Credits = _Credits_

  it 'should do something', () ->
    expect(!!Credits).toBe true
