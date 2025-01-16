
<!-- Modal for Form 1 -->
<div class="modal fade" id="form1Modal" tabindex="-1" aria-labelledby="form1ModalLabel" aria-hidden="true">
<input type="hidden" id="form1SubmissionId">
<input type="hidden" id="form1Type">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="form1ModalContent">
            <div class="modal-header">
                <h5 class="modal-title" id="form1ModalLabel">Initial Project Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form1Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label" >Program / Project Title: </label>
                            <input type="text" id="projectTitleForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyForm1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Component Details:</label>
                            <input type="text" id="compDetailsForm1" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Fund Source:</label>
                            <input type="text" id="fundSourceForm1" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Funding Agency:</label>
                            <input type="text" id="fundAgencyForm1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label class="form-label">Mode of Implementation:</label>
                            <input type="text" id="modeOfImplementationForm1" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Sector:</label>
                            <input type="text" id="sectorForm1" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Total Program / Project Cost (PHP):</label>
                            <input type="text" id="totalCostForm1" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Start Date:</label>
                            <input type="date" id="startDateForm1" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">End Date:</label>
                            <input type="date" id="endDateForm1" class="form-control">
                        </div>
                    </div>

                    <!-- Location -->
                    <h6><b>Location</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Province:</label>
                            <input type="text" id="locationForm1" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">City/Municipality:</label>
                            <input type="text" id="cityForm1" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Barangay:</label>
                            <input type="text" id="barangayForm1" class="form-control">
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h6><b>Additional Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Remarks:</label>
                            <input type="text" id="remarksForm1" class="form-control">
                        </div>
                    </div>

                    <!-- Target Employment Generated -->
                    <h6><b>Target Employment Generated</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Male:</label>
                            <input type="text" id="maleForm1" class="form-control" >
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Female:</label>
                            <input type="text" id="femaleForm1" class="form-control" >
                        </div>
                    </div>

                    <!-- Output Indicators -->
                    <h6><b>Output Indicators</b></h6>
                    <div id="outputIndicatorsContainer"></div>

                    <!-- Year Financial Targets -->
                    <h6><b>Year Financial Targets</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label class="form-label">Financial Targets:</label>
                            <input type="text" id="financialTargetsForm1" class="form-control" >
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Physical Targets (%):</label>
                            <input type="text" id="physicalTargetsForm1" class="form-control">
                        </div>
                    </div>

                    <!-- Targets of Output -->
                    <h6><b>Targets of Output</b></h6>
                    <div id="targetOutputsContainer"></div>

                    <!-- Per Month/Quarter Financial Targets -->
                    <h6><b>Per Month/Quarter Financial Targets</b></h6>
                    <div id="monthlyTargetsContainer"></div>

                    <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Submitted Designation:</label>
                        <div class="col-sm-8">
                            <input type="text" id="submittedDesignationForm1" class="form-control">
                        </div>
                    </div>
                    <label class="col-sm-4 col-form-label">Submitted By:</label>
                        <div class="col-sm-8">
                            <input type="text" id="submittedByForm1" class="form-control">
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelForm1" class="btn btn-success">Download as Excel</button>n>
              <!--   <button type="button" id="updateForm1" class="btn btn-primary">Update</button> -->
            </div>
        </div>
    </div>
</div>




<!-- Modal for Form 2 -->
<div class="modal fade" id="form2Modal" tabindex="-1" aria-labelledby="form2ModalLabel" aria-hidden="true">
<input type="hidden" id="form2SubmissionId">
<input type="hidden" id="form2Type">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="form2ModalContent">
            <div class="modal-header">
                <h5 class="modal-title" id="form2ModalLabel">Physical and Financial Accomplishment Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form2Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Program / Project Title:</label>
                            <input type="text" id="projectTitleForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyForm2" class="form-control">
                        </div>
                    </div>

                    <!-- Implementation Schedule -->
                    <h6><b>Implementation Schedule</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <label class="form-label">Start Date:</label>
                            <input type="date" id="startDateForm2" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">End Date:</label>
                            <input type="date" id="endDateForm2" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">Fund Source:</label>
                            <input type="text" id="fundSourceForm2" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">Funding Agency:</label>
                            <input type="text" id="fundAgencyForm2" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Total Program/Project Cost (PHP):</label>
                            <input type="text" id="totalCostForm2" class="form-control">
                        </div>
                    </div>

                    <!-- Financial Status -->
                    <h6><b>Financial Status (in PHP exact figures)</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label class="form-label">Appropriations:</label>
                            <input type="text" id="appropriationsForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Allotment:</label>
                            <input type="text" id="allotmentForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Obligations:</label>
                            <input type="text" id="obligationsForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Disbursements:</label>
                            <input type="text" id="disbursementsForm2" class="form-control">
                        </div>
                    </div>

                    <!-- Physical Accomplishment -->
                    <h6><b>Physical Accomplishment</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label class="form-label">Target OWPA to date (%):</label>
                            <input type="text" id="targetOwpaForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Actual OWPA to date (%):</label>
                            <input type="text" id="actualOwpaForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Slippage:</label>
                            <input type="text" id="slippageForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Output Indicator:</label>
                            <input type="text" id="outputIndicatorForm2" class="form-control">
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h6><b>Additional Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">End-of-Project Target:</label>
                            <input type="text" id="endProjectTargetForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Target to date:</label>
                            <input type="text" id="targetDateForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Actual to date:</label>
                            <input type="text" id="actualDateForm2" class="form-control">
                        </div>
                    </div>

                    <!-- Employment Generated -->
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label class="form-label">Male:</label>
                            <input type="text" id="maleForm2" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label">Female:</label>
                            <input type="text" id="femaleForm2" class="form-control">
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="row mb-3">
                        <label class="form-label">Remarks:</label>
                        <div class="col-sm-12">
                            <textarea id="remarksForm2" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-6 col-form-label">Submitted Designation:</label>
                        <div class="col-sm-8">
                            <input type="text" id="designationForm2" class="form-control" readonly>
                        </div>
                    </div>
                    <label class="col-sm-4 col-form-label">Submitted By:</label>
                        <div class="col-sm-8">
                            <input type="text" id="submittedByForm2" class="form-control">
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelForm2" class="btn btn-success">Download as Excel</button>
                <!-- <button type="button" id="updateForm2" class="btn btn-primary">Update</button> -->
            </div>
        </div>
    </div>
</div>




<!-- Modal for Form 3 -->
<div class="modal fade" id="form3Modal" tabindex="-1" aria-labelledby="form3ModalLabel" aria-hidden="true">
<input type="hidden" id="form3SubmissionId">
<input type="hidden" id="form3Type">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="form3ModalContent">
            <div class="modal-header">
                <h5 class="modal-title" id="form3ModalLabel">Exception Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form3Data">

                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Program / Project Title:</label>
                            <input type="text" id="projectTitleForm3" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyForm3" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Sector:</label>
                            <input type="text" id="sectorForm3" class="form-control">
                        </div>
                    </div>

                    <!-- Location -->
                    <h6><b>Location</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Province:</label>
                            <input type="text" id="provinceForm3" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">City/Municipality:</label>
                            <input type="text" id="cityForm3" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Barangay:</label>
                            <input type="text" id="barangayForm3" class="form-control">
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h6><b>Additional Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Findings:</label>
                            <input type="text" id="findingsForm3" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Typology:</label>
                            <input type="text" id="typologyForm3" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Issue Status:</label>
                            <input type="text" id="issueStatusForm3" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="form-label">Reasons:</label>
                        <div class="col-sm-12">
                            <textarea id="reasonsForm3" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="form-label">Actions Taken:</label>
                        <div class="col-sm-12">
                            <textarea id="actionsTakenForm3" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="form-label">Actions to Be Taken:</label>
                        <div class="col-sm-12">
                            <textarea id="actionsToBeTakenForm3" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <!-- Project Validation -->
                    <h6><b>Project Validation</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted Designation:</label>
                            <input type="text" id="submittedDesignationForm3" class="form-control" readonly>
                        </div>
                    </div>
                    <label class="col-sm-4 col-form-label">Submitted By:</label>
                        <div class="col-sm-8">
                            <input type="text" id="submittedByForm3" class="form-control">
                        </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" id="downloadExcelForm3" class="btn btn-success">Download as Excel</button>
               <!--  <button type="button" id="updateForm3" class="btn btn-primary">Update</button> -->
            </div>
        </div>
    </div>
</div>


<!-- Modal for Form 4 -->
<div class="modal fade" id="form4Modal" tabindex="-1" aria-labelledby="form4ModalLabel" aria-hidden="true">
<input type="hidden" id="form4SubmissionId">
<input type="hidden" id="form4Type">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="form4ModalContent">
            <div class="modal-header">
                <h5 class="modal-title" id="form4ModalLabel">Project Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Fields -->
                <form id="form4Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Program / Project Title: </label>
                            <input type="text" id="projectTitleForm4" class="form-control"readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyForm4" class="form-control">
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h6><b>Additional Details</b></h6>
                    <div class="row mb-3">
                        <label class="form-label">Program/Project Objectives:</label>
                        <div class="col-sm-12">
                            <textarea id="objectivesForm4" class="form-control" rows="3" placeholder="Enter objectives"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="form-label">Results/Outcome Indicator/Target:</label>
                        <div class="col-sm-12">
                            <textarea id="resultIndicatorForm4" class="form-control" rows="3" placeholder="Enter indicator/target"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="form-label">Observed Results/Outcome/Impact:</label>
                        <div class="col-sm-12">
                            <textarea id="observedResultsForm4" class="form-control" rows="3" placeholder="Enter results/outcome/impact"></textarea>
                        </div>
                    </div>

                    <!-- Project Validation -->
                    <h6><b>Project Validation</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted Designation:</label>
                            <input type="text" id="submittedDesignationForm4" class="form-control" readonly>
                        </div>
                    </div>
                    <label class="col-sm-4 col-form-label">Submitted By:</label>
                        <div class="col-sm-8">
                            <input type="text" id="submittedByForm4" class="form-control">
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelForm4" class="btn btn-success">Download as Excel</button>
               <!-- <button type="button" id="updateForm4" class="btn btn-primary">Update</button>-->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>