from django.shortcuts import render

# Create your views here.
from django.http import HttpResponse
from .models import Task

# CREATE
def create_task(request):
    Task.objects.create(title="learn github", completed=False)
    return HttpResponse("Task created")
def create_github(request):
    Task.objects.create(title="learn github", completed=False)
    return HttpResponse("GitHub task created")

def create_sport(request):
    Task.objects.create(title="learn sport", completed=False)
    return HttpResponse("Sport task created")

def create_music(request):
    Task.objects.create(title="learn music", completed=False)
    return HttpResponse("Music task created")

# UPDATE
def update_task(request, task_id):
    task = Task.objects.get(id=task_id)
    task.completed = True
    task.save()
    return HttpResponse("Task updated")

def task_list(request):
    tasks = Task.objects.all()
    return render(request, 'tasks/task_list.html', {'tasks': tasks})



# DELETE
# def delete_task(request, task_id):
#     task = Task.objects.get(id=task_id)
#     task.delete()
#     return HttpResponse("Task deleted")