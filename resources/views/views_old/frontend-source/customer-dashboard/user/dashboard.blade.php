<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fal fa-smile-beam text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <h4 class="card-title">{{ (new \App\Helpers\CustomerHelper)->medicalMateStatistics([5]) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i>MEDICAL MATE SERVICE COMPLETED
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fal fa-frown text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <!--<p class="card-category">Revenue</p>-->
                                    <h4 class="card-title">{{ (new \App\Helpers\CustomerHelper)->medicalMateStatistics([4]) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> MEDICAL MATE SERVICE CANCELLED
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="far fa-file-prescription text-info"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <!--<p class="card-category">Errors</p>-->
                                    <h4 class="card-title">{{ (new \App\Helpers\CustomerHelper)->customerPrescriptionStatistics([1,2,3,4,5]) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i>PRESCRIPTION UPLOADED
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="far fa-truck text-success"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <!--<p class="card-category">Followers</p>-->
                                    <h4 class="card-title">{{ (new \App\Helpers\CustomerHelper)->customerPrescriptionStatistics([6]) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i>PRESCRIPTION DELIVERED
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="far fa-undo-alt text-dark"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <!--<p class="card-category">Revenue</p>-->
                                    <h4 class="card-title">{{ (new \App\Helpers\CustomerHelper)->customerPrescriptionStatistics([8]) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i>PRESCRIPTION RETURNED
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="far fa-ban text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <!--<p class="card-category">Number</p>-->
                                    <h4 class="card-title">{{ (new \App\Helpers\CustomerHelper)->customerPrescriptionStatistics([0]) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i>PRESCRIPTION CANCELLED
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Email Statistics</h4>
                <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-body ">
                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Open
                    <i class="fa fa-circle text-danger"></i> Bounce
                    <i class="fa fa-circle text-warning"></i> Unsubscribe
                </div>
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">2017 Sales</h4>
                <p class="card-category">All products including Taxes</p>
            </div>
            <div class="card-body ">
                <div id="chartActivity" class="ct-chart"></div>
            </div>
            <div class="card-footer ">
                <div class="legend">
                    <i class="fa fa-circle text-info"></i> Tesla Model S
                    <i class="fa fa-circle text-danger"></i> BMW 5 Series
                </div>
                <hr>
                <div class="stats">
                    <i class="fa fa-check"></i> Data information certified
                </div>
            </div>
        </div>
    </div>
</div>-->