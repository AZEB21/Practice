from django.shortcuts import render, redirect, get_object_or_404
from django.http import HttpResponse, HttpResponseNotAllowed
from .models import Task


# CREATE
def create_task(request):
    # Only allow POST for creating a task with a provided title
    if request.method != 'POST':
        return HttpResponseNotAllowed(['POST'])
    title = request.POST.get('title', '').strip()
    if title:
        Task.objects.create(title=title, completed=False)
    return redirect('task-list')

def create_github(request):
    # Backwards-compatible quick endpoint (GET)
    Task.objects.create(title="learn github", completed=False)
    return HttpResponse("GitHub task created")

def create_sport(request):
    Task.objects.create(title="learn sport", completed=False)
    return HttpResponse("Sport task created")

def create_music(request):
    Task.objects.create(title="learn music", completed=False)
    return HttpResponse("Music task created")


# UPDATE (toggle completed)
def update_task(request, task_id):
    if request.method != 'POST':
        return HttpResponseNotAllowed(['POST'])
    task = get_object_or_404(Task, id=task_id)
    task.completed = not task.completed
    task.save()
    return redirect('task-list')


def task_list(request):
    tasks = Task.objects.all().order_by('-created_at')
    return render(request, 'tasks/task_list.html', {'tasks': tasks})



# DELETE
def delete_task(request, task_id):
    if request.method != 'POST':
        return HttpResponseNotAllowed(['POST'])
    task = get_object_or_404(Task, id=task_id)
    task.delete()
    return redirect('task-list')