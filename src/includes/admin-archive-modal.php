
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
                            <label class="form-label">Program / Project Title:</label>
                            <input type="text" id="projectTitleForm1" class="form-control">
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
                <button type="button" id="downloadExcelForm1" class="btn btn-success">Download as Excel</button>
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
                            <input type="text" id="projectTitleForm2" class="form-control">
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
                            <input type="text" id="projectTitleForm3" class="form-control">
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
                            <label class="form-label">Program / Project Title:</label>
                            <input type="text" id="projectTitleForm4" class="form-control">
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
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="adminForm1Modal" tabindex="-1" aria-labelledby="adminForm1ModalLabel" aria-hidden="true">
    <input type="hidden" id="adminform1SubmissionId">
    <input type="hidden" id="adminform1Type">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm1ModalLabel">SUMMARY OF FINANCIAL AND PHYSICAL ACCOMPLISMENTS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm1Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Project Title:</label>
                            <input type="text" id="projectTitleAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyAdminForm1" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Sector:</label>
                            <input type="text" id="sectorAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Fund Source:</label>
                            <input type="text" id="fundSourceAdminForm1" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Funding Agency:</label>
                            <input type="text" id="fundingAgencyAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Total Project Cost:</label>
                            <input type="text" id="totalProjectCostAdminForm1" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Start Date:</label>
                            <input type="date" id="startDateAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">End Date:</label>
                            <input type="date" id="endDateAdminForm1" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Financial Details -->
                    <h6><b>Financial Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Appropriations:</label>
                            <input type="text" id="appropriationsAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Allotment:</label>
                            <input type="text" id="allotmentAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Obligations:</label>
                            <input type="text" id="obligationsAdminForm1" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Disbursements:</label>
                            <input type="text" id="disbursementsAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Funding Support:</label>
                            <input type="text" id="fundingSupportAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Fund Utilization (%):</label>
                            <input type="text" id="fundUtilizationAdminForm1" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Performance Details -->
                    <h6><b>Performance Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Target OWPA:</label>
                            <input type="text" id="targetOwpaAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Actual OWPA:</label>
                            <input type="text" id="actualOwpaAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Slippage (%):</label>
                            <input type="text" id="slippageAdminForm1" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Employment -->
                    <h6><b>Employment Generated</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Male:</label>
                            <input type="number" id="maleAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Female:</label>
                            <input type="number" id="femaleAdminForm1" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <h6><b>Remarks</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <textarea id="remarksAdminForm1" class="form-control" rows="3" readonly></textarea>
                        </div>
                    </div>

                    <!-- Submission Details -->
                    <h6><b>Submission Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm1" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm1" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submission Date:</label>
                            <input type="date" id="submissionDateAdminForm1" class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin1" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="adminForm2Modal" tabindex="-1" aria-labelledby="adminForm2ModalLabel" aria-hidden="true">
    <input type="hidden" id="adminform2SubmissionId">
    <input type="hidden" id="adminform2Type">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm2ModalLabel">Admin Form 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm2Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Project Title:</label>
                            <input type="text" id="projectTitleAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Location:</label>
                            <input type="text" id="locationAdminForm2" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Fund Utilization:</label>
                            <input type="text" id="fundUtilizationAdminForm2" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h6><b>Additional Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Target OWPA:</label>
                            <input type="text" id="targetOwpaAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Actual OWPA:</label>
                            <input type="text" id="actualOwpaAdminForm2" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Slippage:</label>
                            <input type="text" id="slippageAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Issue Typology:</label>
                            <input type="text" id="issueTypologyAdminForm2" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Issue Details:</label>
                            <textarea id="issueDetailsAdminForm2" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Issue Status:</label>
                            <input type="text" id="issueStatusAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Source of Information:</label>
                            <input type="text" id="sourceOfInformationAdminForm2" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Actions -->
                    <h6><b>Actions</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Action Taken:</label>
                            <textarea id="actionTakenAdminForm2" class="form-control" rows="2" readonly></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Actions to Be Taken:</label>
                            <textarea id="actionsToBeTakenAdminForm2" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">For NPMC Action:</label>
                            <textarea id="forNpmcActionAdminForm2" class="form-control" rows="2" readonly></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Requested Action From NPMC:</label>
                            <textarea id="requestedActionFromNpmcAdminForm2" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>

                    <!-- Submission Details -->
                    <h6><b>Submission Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm2" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Submission Date:</label>
                            <input type="date" id="submissionDateAdminForm2" class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin2" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminForm3Modal" tabindex="-1" aria-labelledby="adminForm3ModalLabel" aria-hidden="true">
    <input type="hidden" id="adminform3SubmissionId">
    <input type="hidden" id="adminform3Type">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm3ModalLabel">Admin Form 3</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm3Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Project Title:</label>
                            <input type="text" id="projectTitleAdminForm3" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyAdminForm3" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Total Cost:</label>
                            <input type="text" id="totalCostAdminForm3" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Location:</label>
                            <input type="text" id="locationAdminForm3" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Inspection Details -->
                    <h6><b>Inspection Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Date of Inspection:</label>
                            <input type="text" id="dateOfInspectionAdminForm3" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Details on Site Inspected:</label>
                            <input type="text" id="detailsOnSiteInspectedAdminForm3" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Findings and Issues -->
                    <h6><b>Findings and Issues</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Findings:</label>
                            <textarea id="findingsAdminForm3" class="form-control" rows="3" readonly></textarea>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label">Issues:</label>
                            <textarea id="issuesAdminForm3" class="form-control" rows="3" readonly></textarea>
                        </div>
                    </div>

                    <!-- Actions -->
                    <h6><b>Actions</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Actions Taken:</label>
                            <textarea id="actionsTakenAdminForm3" class="form-control" rows="2" readonly></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Actions to Be Taken:</label>
                            <textarea id="actionsToBeTakenAdminForm3" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>

                    <!-- Submission Details -->
                    <h6><b>Submission Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm3" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm3" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Submission Date:</label>
                            <input type="date" id="submissionDateAdminForm3" class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin3" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminForm4Modal" tabindex="-1" aria-labelledby="adminForm4ModalLabel" aria-hidden="true">
    <input type="hidden" id="adminform4SubmissionId">
    <input type="hidden" id="adminform4Type">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm4ModalLabel">Admin Form 4</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm4Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Project Title:</label>
                            <input type="text" id="projectTitleAdminForm4" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Issue Details:</label>
                            <input type="text" id="issueDetailsAdminForm4" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Issue Typology:</label>
                            <input type="text" id="issueTypologyAdminForm4" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Location:</label>
                            <input type="text" id="locationAdminForm4" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Meeting Details -->
                    <h6><b>Meeting Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyAdminForm4" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Date of Meeting:</label>
                            <input type="date" id="dateOfMeetingAdminForm4" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Concerned Agency:</label>
                            <input type="text" id="concernedAgencyAdminForm4" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Agreements Reached:</label>
                            <textarea id="agreementsReachedAdminForm4" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>

                    <!-- Submission Details -->
                    <h6><b>Submission Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm4" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm4" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submission Date:</label>
                            <input type="date" id="submissionDateAdminForm4" class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin4" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminForm5Modal" tabindex="-1" aria-labelledby="adminForm5ModalLabel" aria-hidden="true">
    <input type="hidden" id="adminform5SubmissionId">
    <input type="hidden" id="adminform5Type">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm5ModalLabel">Admin Form 5</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm5Data">
                    <!-- Training Details -->
                    <h6><b>Training Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Training Title:</label>
                            <input type="text" id="trainingTitleAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Training Objective:</label>
                            <textarea id="trainingObjectiveAdminForm5" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Training Date:</label>
                            <input type="date" id="trainingDateAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Conducted/Facilitated/Attended:</label>
                            <input type="text" id="conductedFacilitatedAdminForm5" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Participation Details -->
                    <h6><b>Participation Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Lead Office/Unit:</label>
                            <input type="text" id="leadOfficeUnitAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Participating Offices:</label>
                            <textarea id="participatingOfficesAdminForm5" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>

                    <!-- Employment -->
                    <h6><b>Employment Generated</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Male:</label>
                            <input type="number" id="maleAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Female:</label>
                            <input type="number" id="femaleAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Total:</label>
                            <input type="number" id="totalAdminForm5" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Feedback -->
                    <h6><b>Feedback</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <textarea id="resultsFeedbackAdminForm5" class="form-control" rows="3" readonly></textarea>
                        </div>
                    </div>

                    <!-- Submission Details -->
                    <h6><b>Submission Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm5" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Submission Date:</label>
                            <input type="date" id="submissionDateAdminForm5" class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin5" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="adminForm6Modal" tabindex="-1" aria-labelledby="adminForm6ModalLabel" aria-hidden="true">
<input type="hidden" id="adminform6SubmissionId">
<input type="hidden" id="adminform6Type">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm6ModalLabel">Admin Form 6</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm6Data">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Resolution Number:</label>
                            <input type="text" id="resolutionNumberAdminForm6" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Resolution Title:</label>
                            <input type="text" id="resolutionTitleAdminForm6" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Date Approved:</label>
                            <input type="date" id="dateApprovedAdminForm6" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Resolution Link:</label>
                            <a href="#" id="resolutionLinkAdminForm6" target="_blank" class="form-control-link">View Resolution</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Resolution:</label>
                        <textarea id="resolutionAdminForm6" class="form-control" rows="3" readonly></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm6" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm6" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Submission Date:</label>
                        <input type="date" id="submissionDateAdminForm6" class="form-control" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin6" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="adminForm7Modal" tabindex="-1" aria-labelledby="adminForm7ModalLabel" aria-hidden="true">
    <input type="hidden" id="adminform7SubmissionId">
    <input type="hidden" id="adminform7Type">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminForm7ModalLabel">Admin Form 7</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm7Data">
                    <!-- Project Details -->
                    <h6><b>Project Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Project Title:</label>
                            <input type="text" id="projectTitleAdminForm7" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Location:</label>
                            <input type="text" id="locationAdminForm7" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <h6><b>Additional Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Implementing Agency:</label>
                            <input type="text" id="implementingAgencyAdminForm7" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nature:</label>
                            <input type="text" id="natureAdminForm7" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Details:</label>
                            <textarea id="detailsAdminForm7" class="form-control" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Strategies:</label>
                            <textarea id="strategiesAdminForm7" class="form-control" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Responsible Entity:</label>
                            <input type="text" id="responsibleEntityAdminForm7" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Lesson Learned:</label>
                            <textarea id="lessonLearnedAdminForm7" class="form-control" rows="2" readonly></textarea>
                        </div>
                    </div>

                    <!-- Submission Details -->
                    <h6><b>Submission Details</b></h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Submitted By:</label>
                            <input type="text" id="submittedByAdminForm7" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Designation Office:</label>
                            <input type="text" id="designationOfficeAdminForm7" class="form-control" readonly>
                        </div>
                        <div class="row mb-3">
                        <label class="form-label">Submission Date:</label>
                        <input type="date" id="submissionDateAdminForm7" class="form-control" readonly>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="downloadExcelFormAdmin7" class="btn btn-success">Download as Excel</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

