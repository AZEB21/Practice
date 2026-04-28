# # Simple ATM System (Beginner Friendly)

# # Store users in a dictionary
# users = {
#     "1001": {"pin": "1234", "balance": 1000, "locked": False, "attempts": 0, "history": []},
#     "1002": {"pin": "5678", "balance": 2000, "locked": False, "attempts": 0, "history": []}
# }


# def show_menu():
#     print("\n===== ATM FEATURES =====")
#     print("1. Balance Inquiry")
#     print("2. Cash Withdrawal")
#     print("3. Cash Deposit")
#     print("4. Fund Transfer")
#     print("5. Transaction History")
#     print("6. Change PIN")
#     print("7. Exit Safely")

# # Login system with 3 PIN attempts
# account_number = input("Enter your account number: ")

# if account_number not in users:
#     print("Account not found!")
# else:
#     user = users[account_number]

#     if user["locked"]:
#         print("Your account is locked!")
#     else:
#         while user["attempts"] < 3:
#             pin = input("Enter your PIN: ")

#             if pin == user["pin"]:
#                 print("Login successful!")
#                 break
#             else:
#                 user["attempts"] += 1
#                 print("Wrong PIN!")

#         if user["attempts"] == 3:
#             user["locked"] = True
#             print("Account locked due to 3 wrong attempts!")

#         else:
#             while True:
#                 show_menu()
#                 choice = input("Choose an option: ")

#                 if choice == "1":
#                     print("Your balance is:", user["balance"])

#                 elif choice == "2":
#                     amount = float(input("Enter amount to withdraw: "))
#                     if amount <= user["balance"]:
#                         user["balance"] -= amount
#                         user["history"].append(f"Withdrew {amount}")
#                         print("Withdrawal successful!")
#                     else:
#                         print("Insufficient balance!")

#                 elif choice == "3":
#                     amount = float(input("Enter amount to deposit: "))
#                     user["balance"] += amount
#                     user["history"].append(f"Deposited {amount}")
#                     print("Deposit successful!")

#                 elif choice == "4":
#                     target = input("Enter target account number: ")
#                     amount = float(input("Enter amount to transfer: "))

#                     if target in users and amount <= user["balance"]:
#                         user["balance"] -= amount
#                         users[target]["balance"] += amount
#                         user["history"].append(f"Transferred {amount} to {target}")
#                         print("Transfer successful!")
#                     else:
#                         print("Transfer failed!")

#                 elif choice == "5":
#                     print("Transaction History:")
#                     for item in user["history"]:
#                         print("-", item)

#                 elif choice == "6":
#                     new_pin = input("Enter new PIN: ")
#                     user["pin"] = new_pin
#                     print("PIN changed successfully!")

#                 elif choice == "7":
#                     print("Thank you for using the ATM!")
#                     break

#                 else:
#                     print("Invalid option!")

# ===== ATM SYSTEM (Beginner Friendly) =====

users = [

    {"username": "John", "full_name": "John Doe", "account_number": "1234567890", "pin": "1234", "balance": 10000.0, "transaction_history": []},

    {"username": "Ayomide", "full_name": "Ayomide Smith", "account_number": "0987654321", "pin": "5678", "balance": 15000.0, "transaction_history": []},

    {"username": "Samuel", "full_name": "Samuel Johnson", "account_number": "1122334455", "pin": "4321", "balance": 20000.0, "transaction_history": []},

    {"username": "Bob", "full_name": "Bob Brown", "account_number": "5566778899", "pin": "8765", "balance": 5000.0, "transaction_history": []},

    {"username": "Charlie", "full_name": "Charlie Davis", "account_number": "6677889900", "pin": "2468", "balance": 8000.0, "transaction_history": []}

]


# ===== Helper Function to Find User =====
def find_user(account_number):
    for user in users:
        if user["account_number"] == account_number:
            return user
    return None


# ===== Show Menu =====
def show_menu():
    print("\n===== ATM FEATURES =====")
    print("1. Balance Inquiry")
    print("2. Cash Withdrawal")
    print("3. Cash Deposit")
    print("4. Fund Transfer")
    print("5. Transaction History")
    print("6. Change PIN")
    print("7. Exit Safely")


# ===== Login =====
account_number = input("Enter your account number: ")
user = find_user(account_number)

if not user:
    print("Account not found!")
else:
    attempts = 0

    while attempts < 3:
        pin = input("Enter your PIN: ")

        if pin == user["pin"]:
            print("Login successful! Welcome,", user["full_name"])
            break
        else:
            attempts += 1
            print("Wrong PIN!")

    if attempts == 3:
        print("Account locked due to 3 wrong attempts!")
    else:
        while True:
            show_menu()
            choice = input("Choose an option: ")

            # 1. Balance Inquiry
            if choice == "1":
                print("Your balance is:", user["balance"])

            # 2. Withdrawal
            elif choice == "2":
                amount = float(input("Enter amount to withdraw: "))
                if amount <= user["balance"]:
                    user["balance"] -= amount
                    user["transaction_history"].append(f"Withdrew {amount}")
                    print("Withdrawal successful!")
                else:
                    print("Insufficient balance!")

            # 3. Deposit
            elif choice == "3":
                amount = float(input("Enter amount to deposit: "))
                user["balance"] += amount
                user["transaction_history"].append(f"Deposited {amount}")
                print("Deposit successful!")

            # 4. Fund Transfer
            elif choice == "4":
                target_account = input("Enter target account number: ")
                target_user = find_user(target_account)

                if not target_user:
                    print("Target account not found!")
                else:
                    amount = float(input("Enter amount to transfer: "))
                    if amount <= user["balance"]:
                        user["balance"] -= amount
                        target_user["balance"] += amount
                        user["transaction_history"].append(f"Transferred {amount} to {target_user['username']}")
                        print("Transfer successful!")
                    else:
                        print("Insufficient balance!")

            # 5. Transaction History
            elif choice == "5":
                print("Transaction History:")
                if not user["transaction_history"]:
                    print("No transactions yet.")
                else:
                    for t in user["transaction_history"]:
                        print("-", t)

            # 6. Change PIN
            elif choice == "6":
                new_pin = input("Enter new PIN: ")
                user["pin"] = new_pin
                print("PIN changed successfully!")

            # 7. Exit
            elif choice == "7":
                print("Thank you for using the ATM!")
                break

            else:
                print("Invalid option!")
                
                print("hello Azeb")

<?php

header("Content-Type: application/json");

require_once "../config/db.php";

try {
    $sql = "SELECT * FROM results ORDER BY date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
    "status" => "success",
    "data" => $data
]);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
