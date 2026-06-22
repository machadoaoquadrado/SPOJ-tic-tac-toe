# 🧩 SPOJ - Tic-Tac-Toe Game Validator

This project is a PHP solution for the Tic-Tac-Toe validation problem used in the Zabbix developer tasks.

It was tested on SPOJ and received an Accepted verdict.

---

## 🧠 Overview

The goal of the solution is to validate whether a given Tic-Tac-Toe board state is valid according to the game rules.

The input is read from standard input (or a local file for testing), and multiple boards can be processed in a single run.

---

## 🏗️ Structure

The code is split into three main parts:

### ReadData

Handles input reading from either STDIN (SPOJ) or a local file (for testing purposes).  
It reads the input line by line and deals with empty lines when necessary.

---

### Board

Responsible for building and storing the 3x3 board matrix.  
It transforms the raw input into a structured format that can be validated.

---

### GameValidator

Contains the game rules and validation logic:

- counts X, O and empty cells  
- checks valid turn order  
- verifies winning conditions (rows, columns, diagonals)  
- ensures the board state is consistent  

---

## 📌 Notes & Compatibility

- **PHP 7.3.5 Environment:** The SPOJ engine evaluates code using an older PHP version (7.3.5). To ensure total backward compatibility and avoid syntax errors or platform-specific runtime failures, the strict typing directives (`strict_types=1`) and modern return type-hints (like `: self` or `: string`) were omitted or adapted in the submission code.
- **Fixed Size:** The board size is fixed to 3x3, as required by the problem.
- **Input Handling:** Input is assumed to follow SPOJ format, but there is some handling for empty lines and EOF cases to avoid runtime issues.
- **Type Safety:** Strict comparisons (`===`) are used to avoid unexpected type behavior in PHP.

---

## ▶️ How to run

You can run the script changing the constant `LOCAL_TESTING` to `true` inside the code to read from a file, or pipe the input directly via terminal:

**Linux / macOS (Bash):**
```bash
php index.php < input.txt
```
**Windows (PowerShell):**
```powershell
Get-Content input.txt | php index.php
