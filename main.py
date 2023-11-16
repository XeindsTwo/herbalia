from tabulate import tabulate
import numpy as np

# Ввод количества уравнений
while True:
    try:
        n = int(input("Введите количество уравнений (от 2 до 6): "))
        if 2 <= n <= 6:
            break
        else:
            print("Неверное количество уравнений. Попробуйте еще раз.")
    except ValueError:
        print("Неверный ввод. Попробуйте еще раз.")

# Ввод коэффициентов и констант
coefficients = np.zeros((n, n))
constants = np.zeros(n)

print("Введите коэффициенты и константы для каждого уравнения")
print("Пример - 20.9 1.2 2.1 0.9 21.7 - сначала коэффициенты, потом константа")

for i in range(n):
    while True:
        try:
            equation = input(f"Уравнение {i + 1}: ").split()
            equation = list(map(float, equation))
            if len(equation) == n + 1:
                coefficients[i] = equation[:-1]
                constants[i] = equation[-1]
                break
            else:
                print("Неверное количество коэффициентов. Попробуйте еще раз.")
        except ValueError:
            print("Неверный ввод. Попробуйте еще раз.")

# Форматированный вывод коэффициентов и констант
equations_formatted = [equation.tolist() for equation in coefficients]
for i, equation in enumerate(equations_formatted):
    equation.append(constants[i])

print("\nСистема уравнений:")
print(tabulate(equations_formatted, headers=[f"x{i + 1}" for i in range(n)] + ["Константа"], tablefmt="grid"))

# Рассчет значений сигм
sigma_values = []
for j in range(n):
    sigma = (np.sum(np.abs(coefficients[j, :j])) + np.sum(np.abs(coefficients[j, j + 1:]))) / np.abs(coefficients[j, j])
    sigma_values.append(sigma)

# Вывод значений сигм
sigma_table = [[f"Уравнение {j + 1}", f"{sigma_values[j]:.2f}"] for j in range(n)]
print("\nЗначения сигм:")
print(tabulate(sigma_table, headers=["Уравнение", "Сигма"], tablefmt="grid"))


# Функция метода Якоби
def jacobi_method(coefficients, constants, x, iterations):
    diagonal = np.diag(np.diag(coefficients))
    non_diagonal = coefficients - diagonal
    x_list = [x.copy()]
    iteration_table = []

    for i in range(iterations):
        x_new = (constants - np.dot(non_diagonal, x)) / np.diag(diagonal)
        x = x_new
        x_list.append(x.copy())

        # Prepare iteration data for tabulate
        iteration_data = [f"Итерация {i + 1}"] + [round(val, 2) for val in x]
        iteration_table.append(iteration_data)

    # Print iterations using tabulate
    print("\nИтерации:")
    print(tabulate(iteration_table, headers=["Шаг"] + [f"x{i + 1}" for i in range(len(x))], tablefmt="grid"))

    return x_list


# Начальное предположение для значений x
initial_guess = np.zeros(len(constants))
iterations = 20

iteration_values = jacobi_method(coefficients, constants, initial_guess, iterations)
