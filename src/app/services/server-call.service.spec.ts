import { TestBed } from '@angular/core/testing';

import { ServerCallService } from './server-call.service';

describe('ServerCallService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ServerCallService = TestBed.get(ServerCallService);
    expect(service).toBeTruthy();
  });
});
