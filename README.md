# SPOJ - Tic-Tac-Toe Game Validator

This repository contains a professional PHP solution for the Tic-Tac-Toe validation challenge available on the Zabbix developer tasks. The solution has been successfully tested and approved (**Accepted**) by the SPOJ online judge system.

## 🚀 Architectural Decisions & Quality

Following standard clean code practices and SOLID principles (specifically the Single Responsibility Principle), the solution was decoupled into three highly cohesive classes:

* **`ReadData`**: Responsible solely for standard I/O streams handling (`STDIN` / file buffers), ensuring memory efficiency while parsing streams line by line.
* **`Board`**: Acts as a Data Transfer Object (DTO) / Value Object. It encapsulates the board state and matrix generation logic, protecting internal data structure consistency.
* **`GameValidator`**: Houses the core domain business logic. It orchestrates game validation rules completely detached from how the data was initially read.

## 🛠️ Design Patterns & Best Practices Applied

* **KISS (Keep It Simple, Stupid)**: Avoided over-engineering on matrix lookups. Checking rows, columns, and diagonals directly via coordinate indexes ensures $O(1)$ time complexity and native performance, bypassing heavy PHP array filtering overhead.
* **Defensive Programming**: Implemented explicit type conversions (`(int)`) and strict comparisons (`===`) to mitigate false positives and unexpected runtime warnings commonly raised by dynamic typing.
* **Resiliency**: Handles trailing blank lines and EOF discrepancies gracefully, ensuring full compatibility with competitive programming judge automated pipelines.

## 🏁 How to Run

You can pipe any text fixture containing the challenge standard input structure directly into the script:

```bash
php index.php < input.txt
