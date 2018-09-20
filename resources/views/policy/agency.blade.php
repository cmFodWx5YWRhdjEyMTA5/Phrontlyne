 <div class="tab-pane " id="agencydetails">
                    <section class="panel panel-default">

                              <header class="panel-heading">
                    
                      <div class="input-group text-ms">
                        <input type="text" name='agentsearch' id='agentsearch' data-minlength="3" class="input-sm form-control" placeholder="Search by ID or Name">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-dark" type="button" data-validate="parsley" onclick="loadAgent()">Search!</button>
                        </div>
                      </div>
                    </header>
                                <div class="panel-body">

                        
                                      <div class="table-responsive">
                      <table id="agentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                        
                            <th>Name </th>
                            <th>Agent ID</th>
                            <th>Type</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
 
                      </table>
                    </div>           
                </div>
                </section>
                </div>
                 {{--end social Media--}}