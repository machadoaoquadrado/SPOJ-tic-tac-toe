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

## 📌 Notes

- The board size is fixed to 3x3, as required by the problem.
- Input is assumed to follow SPOJ format, but there is some handling for empty lines and EOF cases to avoid runtime issues.
- Strict comparisons (`===`) are used to avoid unexpected type behavior in PHP.

---

## ▶️ How to run

You can run the script changing constant LOCAL_TESTING and using standard input:

```php
const LOCAL_TESTING = true;
```

```bash
php index.php < input.txt
