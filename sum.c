#include <stdio.h>
int main() {
    int n, a, sum = 0;
    printf("roll number=2128\n");
    printf("Input n: ");
    scanf("%d", &n);
    for(a = 1; a <= n; a++) {
        sum = sum + a;
    }
    printf("Summation = %d\n", sum);
    getchar();
    getchar();
    return 0;
}
