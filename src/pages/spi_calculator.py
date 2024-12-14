from datetime import datetime
import json
import sys
import google.generativeai as genai

# Configure the generative AI API
api_key = "AIzaSyB5zPkh-3FGD_3POKymSClbJWyi6k4qSIo"
try:
    genai.configure(api_key=api_key)
except Exception as e:
    print(json.dumps({"error": f"Failed to configure Generative AI: {str(e)}"}))
    sys.exit(1)

generation_config = {
    "temperature": 0.9,
    "top_p": 1,
    "top_k": 1,
    "max_output_tokens": 2048
}

try:
    model = genai.GenerativeModel("gemini-pro", generation_config=generation_config)
except Exception as e:
    print(json.dumps({"error": f"Failed to initialize GenerativeModel: {str(e)}"}))
    sys.exit(1)

# Check and parse command-line arguments
if len(sys.argv) < 16:
    missing_args = 16 - len(sys.argv)
    print(f"Error: Missing {missing_args} arguments.")
    sys.exit(1)

try:
    start = datetime.strptime(sys.argv[1], "%Y-%m-%d").date()
    end = datetime.strptime(sys.argv[2], "%Y-%m-%d").date()
    total_cost = float(sys.argv[3])
    appropriations = float(sys.argv[4])
    target_owpa = float(sys.argv[5])
    actual_owpa = float(sys.argv[6])
    slippage = float(sys.argv[7])
    target_date = datetime.strptime(sys.argv[8], "%Y-%m-%d").date()
    actual_date = datetime.strptime(sys.argv[9], "%Y-%m-%d").date()
    finding = sys.argv[10]
    typology = sys.argv[11]
    issue_status = sys.argv[12]
    reasons = sys.argv[13]
    action_taken = sys.argv[14]
    action_to_be_taken = sys.argv[15]
    project_name = sys.argv[16]
except (ValueError, KeyError, json.JSONDecodeError) as e:
    print(json.dumps({"error": f"Invalid input data: {str(e)}"}))
    sys.exit(1)

# Define calculation functions
def calculate_pv(total_cost, target_owpa):
    return total_cost * target_owpa

def calculate_ev(total_cost, actual_owpa):
    return total_cost * actual_owpa

def calculate_spi(PV, EV):
    return EV / PV if PV > 0 else 0

def determine_status(spi):
    if spi > 1.23:
        return "Ahead of schedule, high confidence"
    elif 1.054 < spi <= 1.23:
        return "Slightly ahead of schedule"
    elif 1.00 <= spi <= 1.054:
        return "On schedule (baseline)"
    elif 0.987 <= spi < 1.00:
        return "Slightly behind schedule"
    elif 0.975 <= spi < 0.987:
        return "Behind schedule, moderate impact"
    elif 0.750 <= spi < 0.975:
        return "Significantly behind schedule"
    elif 0.543 <= spi < 0.750:
        return "Major delay"
    elif 0.320 <= spi < 0.543:
        return "Severe delay"
    else:
        return "Severe major super delay"

# Perform calculations
PV = calculate_pv(total_cost, target_owpa)
EV = calculate_ev(total_cost, actual_owpa)
spi = calculate_spi(PV, EV)
status = determine_status(spi)

# Construct AI prompt
prompt = f"""
Provide prioritized recommendations to improve project outcomes, assumptions made during the analysis, and key risk factors.
Project Name: {project_name}
Start Date: {start}
End Date: {end}
Total Cost: {total_cost}
Target OWPA: {target_owpa}
Actual OWPA: {actual_owpa}
Finding: {finding}
Issue Status: {issue_status}
Reasons: {reasons}
Action Taken: {action_taken}
Action to be Taken: {action_to_be_taken}
"""

# Using the generative model to generate content based on the provided prompt
response = model.generate_content(prompt)

# Generate AI response
try:
    response = model.generate_content(prompt)
     # Extract text from the response
    issue_details = response.candidates[0].content.parts[0].text
except Exception as e:
    response_content = f"Error generating AI response: {e}"

# Output data
output_data = f"""
Project Name: {project_name}
SPI: {spi:.2f}
Status: {status}
Issue Details: {issue_details}
PV: {PV:.2f}
EV: {EV:.2f}
"""
print(output_data)
